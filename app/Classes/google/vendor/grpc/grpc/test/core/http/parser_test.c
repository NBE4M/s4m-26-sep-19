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

#include "src/core/lib/http/parser.h"

#include <stdarg.h>
#include <string.h>

#include <grpc/support/alloc.h>
#include <grpc/support/log.h>
#include <grpc/support/string_util.h>
#include <grpc/support/useful.h>
#include "test/core/util/slice_splitter.h"
#include "test/core/util/test_config.h"

static void test_request_succeeds(grpc_slice_split_mode split_mode,
                                  char *request_text, char *expect_method,
                                  grpc_http_version expect_version,
                                  char *expect_path, char *expect_body, ...) {
  grpc_http_parser parser;
  gpr_slice input_slice = gpr_slice_from_copied_string(request_text);
  size_t num_slices;
  size_t i;
  gpr_slice *slices;
  va_list args;
  grpc_http_request request;
  memset(&request, 0, sizeof(request));

  grpc_split_slices(split_mode, &input_slice, 1, &slices, &num_slices);
  gpr_slice_unref(input_slice);

  grpc_http_parser_init(&parser, GRPC_HTTP_REQUEST, &request);

  for (i = 0; i < num_slices; i++) {
    GPR_ASSERT(grpc_http_parser_parse(&parser, slices[i]) == GRPC_ERROR_NONE);
    gpr_slice_unref(slices[i]);
  }
  GPR_ASSERT(grpc_http_parser_eof(&parser) == GRPC_ERROR_NONE);

  GPR_ASSERT(GRPC_HTTP_REQUEST == parser.type);
  GPR_ASSERT(0 == strcmp(expect_method, request.method));
  GPR_ASSERT(0 == strcmp(expect_path, request.path));
  GPR_ASSERT(expect_version == request.version);

  if (expect_body != NULL) {
    GPR_ASSERT(strlen(expect_body) == request.body_length);
    GPR_ASSERT(0 == memcmp(expect_body, request.body, request.body_length));
  } else {
    GPR_ASSERT(request.body_length == 0);
  }

  va_start(args, expect_body);
  i = 0;
  for (;;) {
    char *expect_key;
    char *expect_value;
    expect_key = va_arg(args, char *);
    if (!expect_key) break;
    GPR_ASSERT(i < request.hdr_count);
    expect_value = va_arg(args, char *);
    GPR_ASSERT(expect_value);
    GPR_ASSERT(0 == strcmp(expect_key, request.hdrs[i].key));
    GPR_ASSERT(0 == strcmp(expect_value, request.hdrs[i].value));
    i++;
  }
  va_end(args);
  GPR_ASSERT(i == request.hdr_count);

  grpc_http_request_destroy(&request);
  grpc_http_parser_destroy(&parser);
  gpr_free(slices);
}

static void test_succeeds(grpc_slice_split_mode split_mode, char *response_text,
                          int expect_status, char *expect_body, ...) {
  grpc_http_parser parser;
  gpr_slice input_slice = gpr_slice_from_copied_string(response_text);
  size_t num_slices;
  size_t i;
  gpr_slice *slices;
  va_list args;
  grpc_http_response response;
  memset(&response, 0, sizeof(response));

  grpc_split_slices(split_mode, &input_slice, 1, &slices, &num_slices);
  gpr_slice_unref(input_slice);

  grpc_http_parser_init(&parser, GRPC_HTTP_RESPONSE, &response);

  for (i = 0; i < num_slices; i++) {
    GPR_ASSERT(grpc_http_parser_parse(&parser, slices[i]) == GRPC_ERROR_NONE);
    gpr_slice_unref(slices[i]);
  }
  GPR_ASSERT(grpc_http_parser_eof(&parser) == GRPC_ERROR_NONE);

  GPR_ASSERT(GRPC_HTTP_RESPONSE == parser.type);
  GPR_ASSERT(expect_status == response.status);
  if (expect_body != NULL) {
    GPR_ASSERT(strlen(expect_body) == response.body_length);
    GPR_ASSERT(0 == memcmp(expect_body, response.body, response.body_length));
  } else {
    GPR_ASSERT(response.body_length == 0);
  }

  va_start(args, expect_body);
  i = 0;
  for (;;) {
    char *expect_key;
    char *expect_value;
    expect_key = va_arg(args, char *);
    if (!expect_key) break;
    GPR_ASSERT(i < response.hdr_count);
    expect_value = va_arg(args, char *);
    GPR_ASSERT(expect_value);
    GPR_ASSERT(0 == strcmp(expect_key, response.hdrs[i].key));
    GPR_ASSERT(0 == strcmp(expect_value, response.hdrs[i].value));
    i++;
  }
  va_end(args);
  GPR_ASSERT(i == response.hdr_count);

  grpc_http_response_destroy(&response);
  grpc_http_parser_destroy(&parser);
  gpr_free(slices);
}

static void test_fails(grpc_slice_split_mode split_mode, char *response_text) {
  grpc_http_parser parser;
  gpr_slice input_slice = gpr_slice_from_copied_string(response_text);
  size_t num_slices;
  size_t i;
  gpr_slice *slices;
  grpc_error *error = GRPC_ERROR_NONE;
  grpc_http_response response;
  memset(&response, 0, sizeof(response));

  grpc_split_slices(split_mode, &input_slice, 1, &slices, &num_slices);
  gpr_slice_unref(input_slice);

  grpc_http_parser_init(&parser, GRPC_HTTP_RESPONSE, &response);

  for (i = 0; i < num_slices; i++) {
    if (GRPC_ERROR_NONE == error) {
      error = grpc_http_parser_parse(&parser, slices[i]);
    }
    gpr_slice_unref(slices[i]);
  }
  if (GRPC_ERROR_NONE == error) {
    error = grpc_http_parser_eof(&parser);
  }
  GPR_ASSERT(error != GRPC_ERROR_NONE);
  GRPC_ERROR_UNREF(error);

  grpc_http_response_destroy(&response);
  grpc_http_parser_destroy(&parser);
  gpr_free(slices);
}

static void test_request_fails(grpc_slice_split_mode split_mode,
                               char *request_text) {
  grpc_http_parser parser;
  gpr_slice input_slice = gpr_slice_from_copied_string(request_text);
  size_t num_slices;
  size_t i;
  gpr_slice *slices;
  grpc_error *error = GRPC_ERROR_NONE;
  grpc_http_request request;
  memset(&request, 0, sizeof(request));

  grpc_split_slices(split_mode, &input_slice, 1, &slices, &num_slices);
  gpr_slice_unref(input_slice);

  grpc_http_parser_init(&parser, GRPC_HTTP_REQUEST, &request);

  for (i = 0; i < num_slices; i++) {
    if (error == GRPC_ERROR_NONE) {
      error = grpc_http_parser_parse(&parser, slices[i]);
    }
    gpr_slice_unref(slices[i]);
  }
  if (error == GRPC_ERROR_NONE) {
    error = grpc_http_parser_eof(&parser);
  }
  GPR_ASSERT(error != GRPC_ERROR_NONE);
  GRPC_ERROR_UNREF(error);

  grpc_http_request_destroy(&request);
  grpc_http_parser_destroy(&parser);
  gpr_free(slices);
}

int main(int argc, char **argv) {
  size_t i;
  const grpc_slice_split_mode split_modes[] = {GRPC_SLICE_SPLIT_IDENTITY,
                                               GRPC_SLICE_SPLIT_ONE_BYTE};
  char *tmp1, *tmp2;

  grpc_test_init(argc, argv);

  for (i = 0; i < GPR_ARRAY_SIZE(split_modes); i++) {
    test_succeeds(split_modes[i],
                  "HTTP/1.0 200 OK\r\n"
                  "xyz: abc\r\n"
                  "\r\n"
                  "hello world!",
                  200, "hello world!", "xyz", "abc", NULL);
    test_succeeds(split_modes[i],
                  "HTTP/1.0 404 Not Found\r\n"
                  "\r\n",
                  404, NULL, NULL);
    test_succeeds(split_modes[i],
                  "HTTP/1.1 200 OK\r\n"
                  "xyz: abc\r\n"
                  "\r\n"
                  "hello world!",
                  200, "hello world!", "xyz", "abc", NULL);
    test_succeeds(split_modes[i],
                  "HTTP/1.1 200 OK\n"
                  "\n"
                  "abc",
                  200, "abc", NULL);
    test_request_succeeds(split_modes[i],
                          "GET / HTTP/1.0\r\n"
                          "\r\n",
                          "GET", GRPC_HTTP_HTTP10, "/", NULL, NULL);
    test_request_succeeds(split_modes[i],
                          "GET / HTTP/1.0\r\n"
                          "\r\n"
                          "xyz",
                          "GET", GRPC_HTTP_HTTP10, "/", "xyz", NULL);
    test_request_succeeds(split_modes[i],
                          "GET / HTTP/1.1\r\n"
                          "\r\n"
                          "xyz",
                          "GET", GRPC_HTTP_HTTP11, "/", "xyz", NULL);
    test_request_succeeds(split_modes[i],
                          "GET / HTTP/2.0\r\n"
                          "\r\n"
                          "xyz",
                          "GET", GRPC_HTTP_HTTP20, "/", "xyz", NULL);
    test_request_succeeds(split_modes[i],
                          "GET / HTTP/1.0\r\n"
                          "xyz: abc\r\n"
                          "\r\n"
                          "xyz",
                          "GET", GRPC_HTTP_HTTP10, "/", "xyz", "xyz", "abc",
                          NULL);
    test_request_succeeds(split_modes[i],
                          "GET / HTTP/1.0\n"
                          "\n"
                          "xyz",
                          "GET", GRPC_HTTP_HTTP10, "/", "xyz", NULL);
    test_fails(split_modes[i], "HTTP/1.0\r\n");
    test_fails(split_modes[i], "HTTP/1.2\r\n");
    test_fails(split_modes[i], "HTTP/1.0 000 XYX\r\n");
    test_fails(split_modes[i], "HTTP/1.0 200 OK\n");
    test_fails(split_modes[i], "HTTP/1.0 200 OK\r\n");
    test_fails(split_modes[i], "HTTP/1.0 200 OK\r\nFoo x\r\n");
    test_fails(split_modes[i],
               "HTTP/1.0 200 OK\r\n"
               "xyz: abc\r\n"
               "  def\r\n"
               "\r\n"
               "hello world!");
    test_request_fails(split_modes[i], "GET\r\n");
    test_request_fails(split_modes[i], "GET /\r\n");
    test_request_fails(split_modes[i], "GET / HTTP/0.0\r\n");
    test_request_fails(split_modes[i], "GET / ____/1.0\r\n");
    test_request_fails(split_modes[i], "GET / HTTP/1.2\r\n");
    test_request_fails(split_modes[i], "GET / HTTP/1.0\n");

    tmp1 = gpr_malloc(2 * GRPC_HTTP_PARSER_MAX_HEADER_LENGTH);
    memset(tmp1, 'a', 2 * GRPC_HTTP_PARSER_MAX_HEADER_LENGTH - 1);
    tmp1[2 * GRPC_HTTP_PARSER_MAX_HEADER_LENGTH - 1] = 0;
    gpr_asprintf(&tmp2, "HTTP/1.0 200 OK\r\nxyz: %s\r\n\r\n", tmp1);
    test_fails(split_modes[i], tmp2);
    gpr_free(tmp1);
    gpr_free(tmp2);
  }

  return 0;
}
