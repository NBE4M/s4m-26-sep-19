/*
 *
 * Copyright 2015, Google Inc.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 *
 *     * Redistributions of source code must retain the above copyright
 * notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above
 * copyright notice, this list of conditions and the following disclaimer
 * in the documentation and/or other materials provided with the
 * distribution.
 *     * Neither the name of Google Inc. nor the names of its
 * contributors may be used to endorse or promote products derived from
 * this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

#include <stdio.h>
#include <string.h>

#include <grpc/grpc_security.h>
#include <grpc/support/alloc.h>
#include <grpc/support/log.h>
#include <grpc/support/string_util.h>
#include <grpc/support/useful.h>

#include "src/core/lib/security/context/security_context.h"
#include "src/core/lib/security/transport/security_connector.h"
#include "src/core/lib/support/env.h"
#include "src/core/lib/support/string.h"
#include "src/core/lib/support/tmpfile.h"
#include "src/core/lib/tsi/ssl_transport_security.h"
#include "src/core/lib/tsi/transport_security.h"
#include "test/core/util/test_config.h"

static int check_transport_security_type(const grpc_auth_context *ctx) {
  grpc_auth_property_iterator it = grpc_auth_context_find_properties_by_name(
      ctx, GRPC_TRANSPORT_SECURITY_TYPE_PROPERTY_NAME);
  const grpc_auth_property *prop = grpc_auth_property_iterator_next(&it);
  if (prop == NULL) return 0;
  if (strncmp(prop->value, GRPC_SSL_TRANSPORT_SECURITY_TYPE,
              prop->value_length) != 0) {
    return 0;
  }
  /* Check that we have only one property with this name. */
  if (grpc_auth_property_iterator_next(&it) != NULL) return 0;
  return 1;
}

static int check_peer_property(const tsi_peer *peer,
                               const tsi_peer_property *expected) {
  size_t i;
  for (i = 0; i < peer->property_count; i++) {
    const tsi_peer_property *prop = &peer->properties[i];
    if ((strcmp(prop->name, expected->name) == 0) &&
        (prop->value.length == expected->value.length) &&
        (memcmp(prop->value.data, expected->value.data,
                expected->value.length) == 0)) {
      return 1;
    }
  }
  return 0; /* Not found... */
}

static int check_ssl_peer_equivalence(const tsi_peer *original,
                                      const tsi_peer *reconstructed) {
  /* The reconstructed peer only has CN, SAN and pem cert properties. */
  size_t i;
  for (i = 0; i < original->property_count; i++) {
    const tsi_peer_property *prop = &original->properties[i];
    if ((strcmp(prop->name, TSI_X509_SUBJECT_COMMON_NAME_PEER_PROPERTY) == 0) ||
        (strcmp(prop->name, TSI_X509_SUBJECT_ALTERNATIVE_NAME_PEER_PROPERTY) ==
         0) ||
        (strcmp(prop->name, TSI_X509_PEM_CERT_PROPERTY) == 0)) {
      if (!check_peer_property(reconstructed, prop)) return 0;
    }
  }
  return 1;
}

static void test_unauthenticated_ssl_peer(void) {
  tsi_peer peer;
  tsi_peer rpeer;
  grpc_auth_context *ctx;
  GPR_ASSERT(tsi_construct_peer(1, &peer) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_CERTIFICATE_TYPE_PEER_PROPERTY, TSI_X509_CERTIFICATE_TYPE,
                 &peer.properties[0]) == TSI_OK);
  ctx = tsi_ssl_peer_to_auth_context(&peer);
  GPR_ASSERT(ctx != NULL);
  GPR_ASSERT(!grpc_auth_context_peer_is_authenticated(ctx));
  GPR_ASSERT(check_transport_security_type(ctx));

  rpeer = tsi_shallow_peer_from_ssl_auth_context(ctx);
  GPR_ASSERT(check_ssl_peer_equivalence(&peer, &rpeer));

  tsi_shallow_peer_destruct(&rpeer);
  tsi_peer_destruct(&peer);
  GRPC_AUTH_CONTEXT_UNREF(ctx, "test");
}

static int check_identity(const grpc_auth_context *ctx,
                          const char *expected_property_name,
                          const char **expected_identities,
                          size_t num_identities) {
  grpc_auth_property_iterator it;
  const grpc_auth_property *prop;
  size_t i;
  GPR_ASSERT(grpc_auth_context_peer_is_authenticated(ctx));
  it = grpc_auth_context_peer_identity(ctx);
  for (i = 0; i < num_identities; i++) {
    prop = grpc_auth_property_iterator_next(&it);
    if (prop == NULL) {
      gpr_log(GPR_ERROR, "Expected identity value %s not found.",
              expected_identities[i]);
      return 0;
    }
    if (strcmp(prop->name, expected_property_name) != 0) {
      gpr_log(GPR_ERROR, "Expected peer identity property name %s and got %s.",
              expected_property_name, prop->name);
      return 0;
    }
    if (strncmp(prop->value, expected_identities[i], prop->value_length) != 0) {
      gpr_log(GPR_ERROR, "Expected peer identity %s and got %s.",
              expected_identities[i], prop->value);
      return 0;
    }
  }
  return 1;
}

static int check_x509_cn(const grpc_auth_context *ctx,
                         const char *expected_cn) {
  grpc_auth_property_iterator it = grpc_auth_context_find_properties_by_name(
      ctx, GRPC_X509_CN_PROPERTY_NAME);
  const grpc_auth_property *prop = grpc_auth_property_iterator_next(&it);
  if (prop == NULL) {
    gpr_log(GPR_ERROR, "CN property not found.");
    return 0;
  }
  if (strncmp(prop->value, expected_cn, prop->value_length) != 0) {
    gpr_log(GPR_ERROR, "Expected CN %s and got %s", expected_cn, prop->value);
    return 0;
  }
  if (grpc_auth_property_iterator_next(&it) != NULL) {
    gpr_log(GPR_ERROR, "Expected only one property for CN.");
    return 0;
  }
  return 1;
}

static int check_x509_pem_cert(const grpc_auth_context *ctx,
                               const char *expected_pem_cert) {
  grpc_auth_property_iterator it = grpc_auth_context_find_properties_by_name(
      ctx, GRPC_X509_PEM_CERT_PROPERTY_NAME);
  const grpc_auth_property *prop = grpc_auth_property_iterator_next(&it);
  if (prop == NULL) {
    gpr_log(GPR_ERROR, "Pem certificate property not found.");
    return 0;
  }
  if (strncmp(prop->value, expected_pem_cert, prop->value_length) != 0) {
    gpr_log(GPR_ERROR, "Expected pem cert %s and got %s", expected_pem_cert,
            prop->value);
    return 0;
  }
  if (grpc_auth_property_iterator_next(&it) != NULL) {
    gpr_log(GPR_ERROR, "Expected only one property for pem cert.");
    return 0;
  }
  return 1;
}

static void test_cn_only_ssl_peer_to_auth_context(void) {
  tsi_peer peer;
  tsi_peer rpeer;
  grpc_auth_context *ctx;
  const char *expected_cn = "cn1";
  const char *expected_pem_cert = "pem_cert1";
  GPR_ASSERT(tsi_construct_peer(3, &peer) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_CERTIFICATE_TYPE_PEER_PROPERTY, TSI_X509_CERTIFICATE_TYPE,
                 &peer.properties[0]) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_X509_SUBJECT_COMMON_NAME_PEER_PROPERTY, expected_cn,
                 &peer.properties[1]) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_X509_PEM_CERT_PROPERTY, expected_pem_cert,
                 &peer.properties[2]) == TSI_OK);
  ctx = tsi_ssl_peer_to_auth_context(&peer);
  GPR_ASSERT(ctx != NULL);
  GPR_ASSERT(grpc_auth_context_peer_is_authenticated(ctx));
  GPR_ASSERT(check_identity(ctx, GRPC_X509_CN_PROPERTY_NAME, &expected_cn, 1));
  GPR_ASSERT(check_transport_security_type(ctx));
  GPR_ASSERT(check_x509_cn(ctx, expected_cn));
  GPR_ASSERT(check_x509_pem_cert(ctx, expected_pem_cert));

  rpeer = tsi_shallow_peer_from_ssl_auth_context(ctx);
  GPR_ASSERT(check_ssl_peer_equivalence(&peer, &rpeer));

  tsi_shallow_peer_destruct(&rpeer);
  tsi_peer_destruct(&peer);
  GRPC_AUTH_CONTEXT_UNREF(ctx, "test");
}

static void test_cn_and_one_san_ssl_peer_to_auth_context(void) {
  tsi_peer peer;
  tsi_peer rpeer;
  grpc_auth_context *ctx;
  const char *expected_cn = "cn1";
  const char *expected_san = "san1";
  const char *expected_pem_cert = "pem_cert1";
  GPR_ASSERT(tsi_construct_peer(4, &peer) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_CERTIFICATE_TYPE_PEER_PROPERTY, TSI_X509_CERTIFICATE_TYPE,
                 &peer.properties[0]) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_X509_SUBJECT_COMMON_NAME_PEER_PROPERTY, expected_cn,
                 &peer.properties[1]) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_X509_SUBJECT_ALTERNATIVE_NAME_PEER_PROPERTY, expected_san,
                 &peer.properties[2]) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_X509_PEM_CERT_PROPERTY, expected_pem_cert,
                 &peer.properties[3]) == TSI_OK);
  ctx = tsi_ssl_peer_to_auth_context(&peer);
  GPR_ASSERT(ctx != NULL);
  GPR_ASSERT(grpc_auth_context_peer_is_authenticated(ctx));
  GPR_ASSERT(
      check_identity(ctx, GRPC_X509_SAN_PROPERTY_NAME, &expected_san, 1));
  GPR_ASSERT(check_transport_security_type(ctx));
  GPR_ASSERT(check_x509_cn(ctx, expected_cn));
  GPR_ASSERT(check_x509_pem_cert(ctx, expected_pem_cert));

  rpeer = tsi_shallow_peer_from_ssl_auth_context(ctx);
  GPR_ASSERT(check_ssl_peer_equivalence(&peer, &rpeer));

  tsi_shallow_peer_destruct(&rpeer);
  tsi_peer_destruct(&peer);
  GRPC_AUTH_CONTEXT_UNREF(ctx, "test");
}

static void test_cn_and_multiple_sans_ssl_peer_to_auth_context(void) {
  tsi_peer peer;
  tsi_peer rpeer;
  grpc_auth_context *ctx;
  const char *expected_cn = "cn1";
  const char *expected_sans[] = {"san1", "san2", "san3"};
  const char *expected_pem_cert = "pem_cert1";
  size_t i;
  GPR_ASSERT(tsi_construct_peer(3 + GPR_ARRAY_SIZE(expected_sans), &peer) ==
             TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_CERTIFICATE_TYPE_PEER_PROPERTY, TSI_X509_CERTIFICATE_TYPE,
                 &peer.properties[0]) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_X509_SUBJECT_COMMON_NAME_PEER_PROPERTY, expected_cn,
                 &peer.properties[1]) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_X509_PEM_CERT_PROPERTY, expected_pem_cert,
                 &peer.properties[2]) == TSI_OK);
  for (i = 0; i < GPR_ARRAY_SIZE(expected_sans); i++) {
    GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                   TSI_X509_SUBJECT_ALTERNATIVE_NAME_PEER_PROPERTY,
                   expected_sans[i], &peer.properties[3 + i]) == TSI_OK);
  }
  ctx = tsi_ssl_peer_to_auth_context(&peer);
  GPR_ASSERT(ctx != NULL);
  GPR_ASSERT(grpc_auth_context_peer_is_authenticated(ctx));
  GPR_ASSERT(check_identity(ctx, GRPC_X509_SAN_PROPERTY_NAME, expected_sans,
                            GPR_ARRAY_SIZE(expected_sans)));
  GPR_ASSERT(check_transport_security_type(ctx));
  GPR_ASSERT(check_x509_cn(ctx, expected_cn));
  GPR_ASSERT(check_x509_pem_cert(ctx, expected_pem_cert));

  rpeer = tsi_shallow_peer_from_ssl_auth_context(ctx);
  GPR_ASSERT(check_ssl_peer_equivalence(&peer, &rpeer));

  tsi_shallow_peer_destruct(&rpeer);
  tsi_peer_destruct(&peer);
  GRPC_AUTH_CONTEXT_UNREF(ctx, "test");
}

static void test_cn_and_multiple_sans_and_others_ssl_peer_to_auth_context(
    void) {
  tsi_peer peer;
  tsi_peer rpeer;
  grpc_auth_context *ctx;
  const char *expected_cn = "cn1";
  const char *expected_pem_cert = "pem_cert1";
  const char *expected_sans[] = {"san1", "san2", "san3"};
  size_t i;
  GPR_ASSERT(tsi_construct_peer(5 + GPR_ARRAY_SIZE(expected_sans), &peer) ==
             TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_CERTIFICATE_TYPE_PEER_PROPERTY, TSI_X509_CERTIFICATE_TYPE,
                 &peer.properties[0]) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 "foo", "bar", &peer.properties[1]) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_X509_SUBJECT_COMMON_NAME_PEER_PROPERTY, expected_cn,
                 &peer.properties[2]) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 "chapi", "chapo", &peer.properties[3]) == TSI_OK);
  GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                 TSI_X509_PEM_CERT_PROPERTY, expected_pem_cert,
                 &peer.properties[4]) == TSI_OK);
  for (i = 0; i < GPR_ARRAY_SIZE(expected_sans); i++) {
    GPR_ASSERT(tsi_construct_string_peer_property_from_cstring(
                   TSI_X509_SUBJECT_ALTERNATIVE_NAME_PEER_PROPERTY,
                   expected_sans[i], &peer.properties[5 + i]) == TSI_OK);
  }
  ctx = tsi_ssl_peer_to_auth_context(&peer);
  GPR_ASSERT(ctx != NULL);
  GPR_ASSERT(grpc_auth_context_peer_is_authenticated(ctx));
  GPR_ASSERT(check_identity(ctx, GRPC_X509_SAN_PROPERTY_NAME, expected_sans,
                            GPR_ARRAY_SIZE(expected_sans)));
  GPR_ASSERT(check_transport_security_type(ctx));
  GPR_ASSERT(check_x509_cn(ctx, expected_cn));
  GPR_ASSERT(check_x509_pem_cert(ctx, expected_pem_cert));

  rpeer = tsi_shallow_peer_from_ssl_auth_context(ctx);
  GPR_ASSERT(check_ssl_peer_equivalence(&peer, &rpeer));

  tsi_shallow_peer_destruct(&rpeer);
  tsi_peer_destruct(&peer);
  GRPC_AUTH_CONTEXT_UNREF(ctx, "test");
}

static const char *roots_for_override_api = "roots for override api";

static grpc_ssl_roots_override_result override_roots_success(
    char **pem_root_certs) {
  *pem_root_certs = gpr_strdup(roots_for_override_api);
  return GRPC_SSL_ROOTS_OVERRIDE_OK;
}

static grpc_ssl_roots_override_result override_roots_permanent_failure(
    char **pem_root_certs) {
  return GRPC_SSL_ROOTS_OVERRIDE_FAIL_PERMANENTLY;
}

static void test_default_ssl_roots(void) {
  const char *roots_for_env_var = "roots for env var";

  char *roots_env_var_file_path;
  FILE *roots_env_var_file =
      gpr_tmpfile("test_roots_for_env_var", &roots_env_var_file_path);
  fwrite(roots_for_env_var, 1, strlen(roots_for_env_var), roots_env_var_file);
  fclose(roots_env_var_file);

  /* First let's get the root through the override: set the env to an invalid
     value. */
  gpr_setenv(GRPC_DEFAULT_SSL_ROOTS_FILE_PATH_ENV_VAR, "");
  grpc_set_ssl_roots_override_callback(override_roots_success);
  gpr_slice roots = grpc_get_default_ssl_roots_for_testing();
  char *roots_contents = gpr_dump_slice(roots, GPR_DUMP_ASCII);
  gpr_slice_unref(roots);
  GPR_ASSERT(strcmp(roots_contents, roots_for_override_api) == 0);
  gpr_free(roots_contents);

  /* Now let's set the env var: We should get the contents pointed value
     instead. */
  gpr_setenv(GRPC_DEFAULT_SSL_ROOTS_FILE_PATH_ENV_VAR, roots_env_var_file_path);
  roots = grpc_get_default_ssl_roots_for_testing();
  roots_contents = gpr_dump_slice(roots, GPR_DUMP_ASCII);
  gpr_slice_unref(roots);
  GPR_ASSERT(strcmp(roots_contents, roots_for_env_var) == 0);
  gpr_free(roots_contents);

  /* Now reset the env var. We should fall back to the value overridden using
     the api. */
  gpr_setenv(GRPC_DEFAULT_SSL_ROOTS_FILE_PATH_ENV_VAR, "");
  roots = grpc_get_default_ssl_roots_for_testing();
  roots_contents = gpr_dump_slice(roots, GPR_DUMP_ASCII);
  gpr_slice_unref(roots);
  GPR_ASSERT(strcmp(roots_contents, roots_for_override_api) == 0);
  gpr_free(roots_contents);

  /* Now setup a permanent failure for the overridden roots and we should get
     an empty slice. */
  grpc_set_ssl_roots_override_callback(override_roots_permanent_failure);
  roots = grpc_get_default_ssl_roots_for_testing();
  GPR_ASSERT(GPR_SLICE_IS_EMPTY(roots));

  /* Cleanup. */
  remove(roots_env_var_file_path);
  gpr_free(roots_env_var_file_path);
}

int main(int argc, char **argv) {
  grpc_test_init(argc, argv);
  grpc_init();

  test_unauthenticated_ssl_peer();
  test_cn_only_ssl_peer_to_auth_context();
  test_cn_and_one_san_ssl_peer_to_auth_context();
  test_cn_and_multiple_sans_ssl_peer_to_auth_context();
  test_cn_and_multiple_sans_and_others_ssl_peer_to_auth_context();
  test_default_ssl_roots();

  grpc_shutdown();
  return 0;
}
