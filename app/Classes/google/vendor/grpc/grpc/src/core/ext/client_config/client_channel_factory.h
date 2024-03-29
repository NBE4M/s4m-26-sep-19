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

#ifndef GRPC_CORE_EXT_CLIENT_CONFIG_CLIENT_CHANNEL_FACTORY_H
#define GRPC_CORE_EXT_CLIENT_CONFIG_CLIENT_CHANNEL_FACTORY_H

#include <grpc/impl/codegen/grpc_types.h>

#include "src/core/ext/client_config/subchannel.h"
#include "src/core/lib/channel/channel_stack.h"

typedef struct grpc_client_channel_factory grpc_client_channel_factory;
typedef struct grpc_client_channel_factory_vtable
    grpc_client_channel_factory_vtable;

typedef enum {
  GRPC_CLIENT_CHANNEL_TYPE_REGULAR, /** for the user-level regular calls */
  GRPC_CLIENT_CHANNEL_TYPE_LOAD_BALANCING, /** for communication with a load
                                              balancing service */
} grpc_client_channel_type;

/** Constructor for new configured channels.
    Creating decorators around this type is encouraged to adapt behavior. */
struct grpc_client_channel_factory {
  const grpc_client_channel_factory_vtable *vtable;
};

struct grpc_client_channel_factory_vtable {
  void (*ref)(grpc_client_channel_factory *factory);
  void (*unref)(grpc_exec_ctx *exec_ctx, grpc_client_channel_factory *factory);
  grpc_subchannel *(*create_subchannel)(grpc_exec_ctx *exec_ctx,
                                        grpc_client_channel_factory *factory,
                                        grpc_subchannel_args *args);
  grpc_channel *(*create_client_channel)(grpc_exec_ctx *exec_ctx,
                                         grpc_client_channel_factory *factory,
                                         const char *target,
                                         grpc_client_channel_type type,
                                         grpc_channel_args *args);
};

void grpc_client_channel_factory_ref(grpc_client_channel_factory *factory);
void grpc_client_channel_factory_unref(grpc_exec_ctx *exec_ctx,
                                       grpc_client_channel_factory *factory);

/** Create a new grpc_subchannel */
grpc_subchannel *grpc_client_channel_factory_create_subchannel(
    grpc_exec_ctx *exec_ctx, grpc_client_channel_factory *factory,
    grpc_subchannel_args *args);

/** Create a new grpc_channel */
grpc_channel *grpc_client_channel_factory_create_channel(
    grpc_exec_ctx *exec_ctx, grpc_client_channel_factory *factory,
    const char *target, grpc_client_channel_type type, grpc_channel_args *args);

#endif /* GRPC_CORE_EXT_CLIENT_CONFIG_CLIENT_CHANNEL_FACTORY_H */
