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

#include "channel_credentials.h"
#include "call_credentials.h"

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include <php.h>
#include <php_ini.h>
#include <ext/standard/info.h>
#include <ext/spl/spl_exceptions.h>
#include "php_grpc.h"
#include "call.h"

#include <zend_exceptions.h>
#include <zend_hash.h>

#include <grpc/grpc.h>
#include <grpc/grpc_security.h>

zend_class_entry *grpc_ce_call_credentials;
#if PHP_MAJOR_VERSION >= 7
static zend_object_handlers call_credentials_ce_handlers;
#endif

/* Frees and destroys an instance of wrapped_grpc_call_credentials */
PHP_GRPC_FREE_WRAPPED_FUNC_START(wrapped_grpc_call_credentials)
  if (p->wrapped != NULL) {
    grpc_call_credentials_release(p->wrapped);
  }
PHP_GRPC_FREE_WRAPPED_FUNC_END()

/* Initializes an instance of wrapped_grpc_call_credentials to be
 * associated with an object of a class specified by class_type */
php_grpc_zend_object create_wrapped_grpc_call_credentials(
    zend_class_entry *class_type TSRMLS_DC) {
  PHP_GRPC_ALLOC_CLASS_OBJECT(wrapped_grpc_call_credentials);
  zend_object_std_init(&intern->std, class_type TSRMLS_CC);
  object_properties_init(&intern->std, class_type);
  PHP_GRPC_FREE_CLASS_OBJECT(wrapped_grpc_call_credentials,
                             call_credentials_ce_handlers);
}

zval *grpc_php_wrap_call_credentials(grpc_call_credentials
                                     *wrapped TSRMLS_DC) {
  zval *credentials_object;
  PHP_GRPC_MAKE_STD_ZVAL(credentials_object);
  object_init_ex(credentials_object, grpc_ce_call_credentials);
  wrapped_grpc_call_credentials *credentials =
    Z_WRAPPED_GRPC_CALL_CREDS_P(credentials_object);
  credentials->wrapped = wrapped;
  return credentials_object;
}

/**
 * Create composite credentials from two existing credentials.
 * @param CallCredentials cred1 The first credential
 * @param CallCredentials cred2 The second credential
 * @return CallCredentials The new composite credentials object
 */
PHP_METHOD(CallCredentials, createComposite) {
  zval *cred1_obj;
  zval *cred2_obj;

  /* "OO" == 2 Objects */
  if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "OO", &cred1_obj,
                            grpc_ce_call_credentials, &cred2_obj,
                            grpc_ce_call_credentials) == FAILURE) {
    zend_throw_exception(spl_ce_InvalidArgumentException,
                         "createComposite expects 2 CallCredentials",
                         1 TSRMLS_CC);
    return;
  }
  wrapped_grpc_call_credentials *cred1 =
    Z_WRAPPED_GRPC_CALL_CREDS_P(cred1_obj);
  wrapped_grpc_call_credentials *cred2 =
    Z_WRAPPED_GRPC_CALL_CREDS_P(cred2_obj);
  grpc_call_credentials *creds =
      grpc_composite_call_credentials_create(cred1->wrapped, cred2->wrapped,
                                             NULL);
  zval *creds_object;
  PHP_GRPC_MAKE_STD_ZVAL(creds_object);
  creds_object = grpc_php_wrap_call_credentials(creds TSRMLS_CC);
  RETURN_DESTROY_ZVAL(creds_object);
}

/**
 * Create a call credentials object from the plugin API
 * @param function callback The callback function
 * @return CallCredentials The new call credentials object
 */
PHP_METHOD(CallCredentials, createFromPlugin) {
  zend_fcall_info *fci;
  zend_fcall_info_cache *fci_cache;

  fci = (zend_fcall_info *)emalloc(sizeof(zend_fcall_info));
  fci_cache = (zend_fcall_info_cache *)emalloc(sizeof(zend_fcall_info_cache));
  memset(fci, 0, sizeof(zend_fcall_info));
  memset(fci_cache, 0, sizeof(zend_fcall_info_cache));

  /* "f" == 1 function */
  if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "f*", fci, fci_cache,
                            fci->params, fci->param_count) == FAILURE) {
    zend_throw_exception(spl_ce_InvalidArgumentException,
                         "createFromPlugin expects 1 callback", 1 TSRMLS_CC);
    return;
  }

  plugin_state *state;
  state = (plugin_state *)emalloc(sizeof(plugin_state));
  memset(state, 0, sizeof(plugin_state));

  /* save the user provided PHP callback function */
  state->fci = fci;
  state->fci_cache = fci_cache;

  grpc_metadata_credentials_plugin plugin;
  plugin.get_metadata = plugin_get_metadata;
  plugin.destroy = plugin_destroy_state;
  plugin.state = (void *)state;
  plugin.type = "";

  grpc_call_credentials *creds =
    grpc_metadata_credentials_create_from_plugin(plugin, NULL);
  zval *creds_object;
  PHP_GRPC_MAKE_STD_ZVAL(creds_object);
  creds_object = grpc_php_wrap_call_credentials(creds TSRMLS_CC);
  RETURN_DESTROY_ZVAL(creds_object);
}

/* Callback function for plugin creds API */
void plugin_get_metadata(void *ptr, grpc_auth_metadata_context context,
                         grpc_credentials_plugin_metadata_cb cb,
                         void *user_data) {
  TSRMLS_FETCH();

  plugin_state *state = (plugin_state *)ptr;

  /* prepare to call the user callback function with info from the
   * grpc_auth_metadata_context */
  zval *arg;
  PHP_GRPC_MAKE_STD_ZVAL(arg);
  object_init(arg);
  php_grpc_add_property_string(arg, "service_url", context.service_url, true);
  php_grpc_add_property_string(arg, "method_name", context.method_name, true);
  zval *retval;
  PHP_GRPC_MAKE_STD_ZVAL(retval);
#if PHP_MAJOR_VERSION < 7
  zval **params[1];
  params[0] = &arg;
  state->fci->params = params;
  state->fci->retval_ptr_ptr = &retval;
#else
  state->fci->params = arg;
  state->fci->retval = retval;
#endif
  state->fci->param_count = 1;

  /* call the user callback function */
  zend_call_function(state->fci, state->fci_cache TSRMLS_CC);

  grpc_status_code code = GRPC_STATUS_OK;
  grpc_metadata_array metadata;

  if (Z_TYPE_P(retval) != IS_ARRAY) {
    code = GRPC_STATUS_INVALID_ARGUMENT;
  } else if (!create_metadata_array(retval, &metadata)) {
    grpc_metadata_array_destroy(&metadata);
    code = GRPC_STATUS_INVALID_ARGUMENT;
  }

  /* Pass control back to core */
  cb(user_data, metadata.metadata, metadata.count, code, NULL);
}

/* Cleanup function for plugin creds API */
void plugin_destroy_state(void *ptr) {
  plugin_state *state = (plugin_state *)ptr;
  efree(state->fci);
  efree(state->fci_cache);
  efree(state);
}

static zend_function_entry call_credentials_methods[] = {
  PHP_ME(CallCredentials, createComposite, NULL,
         ZEND_ACC_PUBLIC | ZEND_ACC_STATIC)
  PHP_ME(CallCredentials, createFromPlugin, NULL,
         ZEND_ACC_PUBLIC | ZEND_ACC_STATIC)
  PHP_FE_END
};

void grpc_init_call_credentials(TSRMLS_D) {
  zend_class_entry ce;
  INIT_CLASS_ENTRY(ce, "Grpc\\CallCredentials", call_credentials_methods);
  ce.create_object = create_wrapped_grpc_call_credentials;
  grpc_ce_call_credentials = zend_register_internal_class(&ce TSRMLS_CC);
  PHP_GRPC_INIT_HANDLER(wrapped_grpc_call_credentials,
                        call_credentials_ce_handlers);
}
