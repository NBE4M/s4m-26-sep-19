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

#ifndef NET_GRPC_NODE_COMPLETION_QUEUE_ASYNC_WORKER_H_
#define NET_GRPC_NODE_COMPLETION_QUEUE_ASYNC_WORKER_H_
#include <nan.h>

#include "grpc/grpc.h"

namespace grpc {
namespace node {

/* A worker that asynchronously calls completion_queue_next, and queues onto the
   node event loop a call to the function stored in the event's tag. */
class CompletionQueueAsyncWorker : public Nan::AsyncWorker {
 public:
  CompletionQueueAsyncWorker();

  ~CompletionQueueAsyncWorker();
  /* Calls completion_queue_next with the provided deadline, and stores the
     event if there was one or sets an error message if there was not */
  void Execute();

  /* Returns the completion queue attached to this class */
  static grpc_completion_queue *GetQueue();

  /* Convenience function to create a worker with the given arguments and queue
     it to run asynchronously */
  static void Next();

  /* Initialize the CompletionQueueAsyncWorker class */
  static void Init(v8::Local<v8::Object> exports);

 protected:
  /* Called when Execute has succeeded (completed without setting an error
     message). Calls the saved callback with the event that came from
     completion_queue_next */
  void HandleOKCallback();

  void HandleErrorCallback();

 private:
  grpc_event result;

  static grpc_completion_queue *queue;

  // Number of grpc_completion_queue_next calls in the thread pool
  static int current_threads;
  // Number of grpc_completion_queue_next calls waiting to enter the thread pool
  static int waiting_next_calls;
};

}  // namespace node
}  // namespace grpc

#endif  // NET_GRPC_NODE_COMPLETION_QUEUE_ASYNC_WORKER_H_
