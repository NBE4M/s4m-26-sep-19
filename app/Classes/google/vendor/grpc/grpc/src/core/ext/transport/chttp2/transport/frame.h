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

#ifndef GRPC_CORE_EXT_TRANSPORT_CHTTP2_TRANSPORT_FRAME_H
#define GRPC_CORE_EXT_TRANSPORT_CHTTP2_TRANSPORT_FRAME_H

#include <grpc/support/port_platform.h>
#include <grpc/support/slice.h>

#include "src/core/lib/iomgr/error.h"

/* defined in internal.h */
typedef struct grpc_chttp2_stream_parsing grpc_chttp2_stream_parsing;
typedef struct grpc_chttp2_transport_parsing grpc_chttp2_transport_parsing;

#define GRPC_CHTTP2_FRAME_DATA 0
#define GRPC_CHTTP2_FRAME_HEADER 1
#define GRPC_CHTTP2_FRAME_CONTINUATION 9
#define GRPC_CHTTP2_FRAME_RST_STREAM 3
#define GRPC_CHTTP2_FRAME_SETTINGS 4
#define GRPC_CHTTP2_FRAME_PING 6
#define GRPC_CHTTP2_FRAME_GOAWAY 7
#define GRPC_CHTTP2_FRAME_WINDOW_UPDATE 8

#define GRPC_CHTTP2_MAX_PAYLOAD_LENGTH ((1 << 14) - 1)

#define GRPC_CHTTP2_DATA_FLAG_END_STREAM 1
#define GRPC_CHTTP2_FLAG_ACK 1
#define GRPC_CHTTP2_DATA_FLAG_END_HEADERS 4
#define GRPC_CHTTP2_DATA_FLAG_PADDED 8
#define GRPC_CHTTP2_FLAG_HAS_PRIORITY 0x20

#endif /* GRPC_CORE_EXT_TRANSPORT_CHTTP2_TRANSPORT_FRAME_H */
