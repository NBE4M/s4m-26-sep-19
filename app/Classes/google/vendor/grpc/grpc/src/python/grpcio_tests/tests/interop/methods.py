# Copyright 2015, Google Inc.
# All rights reserved.
#
# Redistribution and use in source and binary forms, with or without
# modification, are permitted provided that the following conditions are
# met:
#
#     * Redistributions of source code must retain the above copyright
# notice, this list of conditions and the following disclaimer.
#     * Redistributions in binary form must reproduce the above
# copyright notice, this list of conditions and the following disclaimer
# in the documentation and/or other materials provided with the
# distribution.
#     * Neither the name of Google Inc. nor the names of its
# contributors may be used to endorse or promote products derived from
# this software without specific prior written permission.
#
# THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
# "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
# LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
# A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
# OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
# SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
# LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
# DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
# THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
# (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
# OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

"""Implementations of interoperability test methods."""

import enum
import json
import os
import threading
import time

from oauth2client import client as oauth2client_client

import grpc
from grpc.beta import implementations

from src.proto.grpc.testing import empty_pb2
from src.proto.grpc.testing import messages_pb2
from src.proto.grpc.testing import test_pb2


class TestService(test_pb2.TestServiceServicer):

  def EmptyCall(self, request, context):
    return empty_pb2.Empty()

  def UnaryCall(self, request, context):
    if request.HasField('response_status'):
      context.set_code(request.response_status.code)
      context.set_details(request.response_status.message)
    return messages_pb2.SimpleResponse(
        payload=messages_pb2.Payload(
            type=messages_pb2.COMPRESSABLE,
            body=b'\x00' * request.response_size))

  def StreamingOutputCall(self, request, context):
    if request.HasField('response_status'):
      context.set_code(request.response_status.code)
      context.set_details(request.response_status.message)
    for response_parameters in request.response_parameters:
      yield messages_pb2.StreamingOutputCallResponse(
          payload=messages_pb2.Payload(
              type=request.response_type,
              body=b'\x00' * response_parameters.size))

  def StreamingInputCall(self, request_iterator, context):
    aggregate_size = 0
    for request in request_iterator:
      if request.payload is not None and request.payload.body:
        aggregate_size += len(request.payload.body)
    return messages_pb2.StreamingInputCallResponse(
        aggregated_payload_size=aggregate_size)

  def FullDuplexCall(self, request_iterator, context):
    for request in request_iterator:
      if request.HasField('response_status'):
        context.set_code(request.response_status.code)
        context.set_details(request.response_status.message)
      for response_parameters in request.response_parameters:
        yield messages_pb2.StreamingOutputCallResponse(
            payload=messages_pb2.Payload(
                type=request.payload.type,
                body=b'\x00' * response_parameters.size))

  # NOTE(nathaniel): Apparently this is the same as the full-duplex call?
  # NOTE(atash): It isn't even called in the interop spec (Oct 22 2015)...
  def HalfDuplexCall(self, request_iterator, context):
    return self.FullDuplexCall(request_iterator, context)


def _large_unary_common_behavior(
    stub, fill_username, fill_oauth_scope, call_credentials):
  request = messages_pb2.SimpleRequest(
      response_type=messages_pb2.COMPRESSABLE, response_size=314159,
      payload=messages_pb2.Payload(body=b'\x00' * 271828),
      fill_username=fill_username, fill_oauth_scope=fill_oauth_scope)
  response_future = stub.UnaryCall.future(
      request, credentials=call_credentials)
  response = response_future.result()
  if response.payload.type is not messages_pb2.COMPRESSABLE:
    raise ValueError(
        'response payload type is "%s"!' % type(response.payload.type))
  elif len(response.payload.body) != 314159:
    raise ValueError(
        'response body of incorrect size %d!' % len(response.payload.body))
  else:
    return response


def _empty_unary(stub):
  response = stub.EmptyCall(empty_pb2.Empty())
  if not isinstance(response, empty_pb2.Empty):
    raise TypeError(
        'response is of type "%s", not empty_pb2.Empty!', type(response))


def _large_unary(stub):
  _large_unary_common_behavior(stub, False, False, None)


def _client_streaming(stub):
  payload_body_sizes = (27182, 8, 1828, 45904,)
  payloads = (
      messages_pb2.Payload(body=b'\x00' * size)
      for size in payload_body_sizes)
  requests = (
      messages_pb2.StreamingInputCallRequest(payload=payload)
      for payload in payloads)
  response = stub.StreamingInputCall(requests)
  if response.aggregated_payload_size != 74922:
    raise ValueError(
        'incorrect size %d!' % response.aggregated_payload_size)


def _server_streaming(stub):
  sizes = (31415, 9, 2653, 58979,)

  request = messages_pb2.StreamingOutputCallRequest(
      response_type=messages_pb2.COMPRESSABLE,
      response_parameters=(
          messages_pb2.ResponseParameters(size=sizes[0]),
          messages_pb2.ResponseParameters(size=sizes[1]),
          messages_pb2.ResponseParameters(size=sizes[2]),
          messages_pb2.ResponseParameters(size=sizes[3]),
      )
  )
  response_iterator = stub.StreamingOutputCall(request)
  for index, response in enumerate(response_iterator):
    if response.payload.type != messages_pb2.COMPRESSABLE:
      raise ValueError(
          'response body of invalid type %s!' % response.payload.type)
    elif len(response.payload.body) != sizes[index]:
      raise ValueError(
          'response body of invalid size %d!' % len(response.payload.body))

def _cancel_after_begin(stub):
  sizes = (27182, 8, 1828, 45904,)
  payloads = (messages_pb2.Payload(body=b'\x00' * size) for size in sizes)
  requests = (messages_pb2.StreamingInputCallRequest(payload=payload)
              for payload in payloads)
  response_future = stub.StreamingInputCall.future(requests)
  response_future.cancel()
  if not response_future.cancelled():
    raise ValueError('expected call to be cancelled')


class _Pipe(object):

  def __init__(self):
    self._condition = threading.Condition()
    self._values = []
    self._open = True

  def __iter__(self):
    return self

  def __next__(self):
    return self.next()

  def next(self):
    with self._condition:
      while not self._values and self._open:
        self._condition.wait()
      if self._values:
        return self._values.pop(0)
      else:
        raise StopIteration()

  def add(self, value):
    with self._condition:
      self._values.append(value)
      self._condition.notify()

  def close(self):
    with self._condition:
      self._open = False
      self._condition.notify()

  def __enter__(self):
    return self

  def __exit__(self, type, value, traceback):
    self.close()


def _ping_pong(stub):
  request_response_sizes = (31415, 9, 2653, 58979,)
  request_payload_sizes = (27182, 8, 1828, 45904,)

  with _Pipe() as pipe:
    response_iterator = stub.FullDuplexCall(pipe)
    for response_size, payload_size in zip(
        request_response_sizes, request_payload_sizes):
      request = messages_pb2.StreamingOutputCallRequest(
          response_type=messages_pb2.COMPRESSABLE,
          response_parameters=(
              messages_pb2.ResponseParameters(size=response_size),),
          payload=messages_pb2.Payload(body=b'\x00' * payload_size))
      pipe.add(request)
      response = next(response_iterator)
      if response.payload.type != messages_pb2.COMPRESSABLE:
        raise ValueError(
            'response body of invalid type %s!' % response.payload.type)
      if len(response.payload.body) != response_size:
        raise ValueError(
            'response body of invalid size %d!' % len(response.payload.body))


def _cancel_after_first_response(stub):
  request_response_sizes = (31415, 9, 2653, 58979,)
  request_payload_sizes = (27182, 8, 1828, 45904,)
  with _Pipe() as pipe:
    response_iterator = stub.FullDuplexCall(pipe)

    response_size = request_response_sizes[0]
    payload_size = request_payload_sizes[0]
    request = messages_pb2.StreamingOutputCallRequest(
        response_type=messages_pb2.COMPRESSABLE,
        response_parameters=(
            messages_pb2.ResponseParameters(size=response_size),),
        payload=messages_pb2.Payload(body=b'\x00' * payload_size))
    pipe.add(request)
    response = next(response_iterator)
    # We test the contents of `response` in the Ping Pong test - don't check
    # them here.
    response_iterator.cancel()

    try:
      next(response_iterator)
    except grpc.RpcError as rpc_error:
      if rpc_error.code() is not grpc.StatusCode.CANCELLED:
        raise
    else:
      raise ValueError('expected call to be cancelled')


def _timeout_on_sleeping_server(stub):
  request_payload_size = 27182
  with _Pipe() as pipe:
    response_iterator = stub.FullDuplexCall(pipe, timeout=0.001)

    request = messages_pb2.StreamingOutputCallRequest(
        response_type=messages_pb2.COMPRESSABLE,
        payload=messages_pb2.Payload(body=b'\x00' * request_payload_size))
    pipe.add(request)
    time.sleep(0.1)
    try:
      next(response_iterator)
    except grpc.RpcError as rpc_error:
      if rpc_error.code() is not grpc.StatusCode.DEADLINE_EXCEEDED:
        raise
    else:
      raise ValueError('expected call to exceed deadline')


def _empty_stream(stub):
  with _Pipe() as pipe:
    response_iterator = stub.FullDuplexCall(pipe)
    pipe.close()
    try:
      next(response_iterator)
      raise ValueError('expected exactly 0 responses')
    except StopIteration:
      pass


def _status_code_and_message(stub):
  message = 'test status message'
  code = 2
  status = grpc.StatusCode.UNKNOWN # code = 2
  request = messages_pb2.SimpleRequest(
      response_type=messages_pb2.COMPRESSABLE,
      response_size=1,
      payload=messages_pb2.Payload(body=b'\x00'),
      response_status=messages_pb2.EchoStatus(code=code, message=message)
  )
  response_future = stub.UnaryCall.future(request)
  if response_future.code() != status:
    raise ValueError(
      'expected code %s, got %s' % (status, response_future.code()))
  elif response_future.details() != message:
    raise ValueError(
      'expected message %s, got %s' % (message, response_future.details()))

  request = messages_pb2.StreamingOutputCallRequest(
      response_type=messages_pb2.COMPRESSABLE,
      response_parameters=(
          messages_pb2.ResponseParameters(size=1),),
      response_status=messages_pb2.EchoStatus(code=code, message=message))
  response_iterator = stub.StreamingOutputCall(request)
  if response_future.code() != status:
    raise ValueError(
      'expected code %s, got %s' % (status, response_iterator.code()))
  elif response_future.details() != message:
    raise ValueError(
      'expected message %s, got %s' % (message, response_iterator.details()))


def _compute_engine_creds(stub, args):
  response = _large_unary_common_behavior(stub, True, True, None)
  if args.default_service_account != response.username:
    raise ValueError(
        'expected username %s, got %s' % (
            args.default_service_account, response.username))


def _oauth2_auth_token(stub, args):
  json_key_filename = os.environ[
      oauth2client_client.GOOGLE_APPLICATION_CREDENTIALS]
  wanted_email = json.load(open(json_key_filename, 'rb'))['client_email']
  response = _large_unary_common_behavior(stub, True, True, None)
  if wanted_email != response.username:
    raise ValueError(
        'expected username %s, got %s' % (wanted_email, response.username))
  if args.oauth_scope.find(response.oauth_scope) == -1:
    raise ValueError(
        'expected to find oauth scope "{}" in received "{}"'.format(
            response.oauth_scope, args.oauth_scope))


def _jwt_token_creds(stub, args):
  json_key_filename = os.environ[
      oauth2client_client.GOOGLE_APPLICATION_CREDENTIALS]
  wanted_email = json.load(open(json_key_filename, 'rb'))['client_email']
  response = _large_unary_common_behavior(stub, True, False, None)
  if wanted_email != response.username:
    raise ValueError(
        'expected username %s, got %s' % (wanted_email, response.username))


def _per_rpc_creds(stub, args):
  json_key_filename = os.environ[
      oauth2client_client.GOOGLE_APPLICATION_CREDENTIALS]
  wanted_email = json.load(open(json_key_filename, 'rb'))['client_email']
  credentials = oauth2client_client.GoogleCredentials.get_application_default()
  scoped_credentials = credentials.create_scoped([args.oauth_scope])
  # TODO(https://github.com/grpc/grpc/issues/6799): Eliminate this last
  # remaining use of the Beta API.
  call_credentials = implementations.google_call_credentials(
      scoped_credentials)
  response = _large_unary_common_behavior(stub, True, False, call_credentials)
  if wanted_email != response.username:
    raise ValueError(
        'expected username %s, got %s' % (wanted_email, response.username))


@enum.unique
class TestCase(enum.Enum):
  EMPTY_UNARY = 'empty_unary'
  LARGE_UNARY = 'large_unary'
  SERVER_STREAMING = 'server_streaming'
  CLIENT_STREAMING = 'client_streaming'
  PING_PONG = 'ping_pong'
  CANCEL_AFTER_BEGIN = 'cancel_after_begin'
  CANCEL_AFTER_FIRST_RESPONSE = 'cancel_after_first_response'
  EMPTY_STREAM = 'empty_stream'
  STATUS_CODE_AND_MESSAGE = 'status_code_and_message'
  COMPUTE_ENGINE_CREDS = 'compute_engine_creds'
  OAUTH2_AUTH_TOKEN = 'oauth2_auth_token'
  JWT_TOKEN_CREDS = 'jwt_token_creds'
  PER_RPC_CREDS = 'per_rpc_creds'
  TIMEOUT_ON_SLEEPING_SERVER = 'timeout_on_sleeping_server'

  def test_interoperability(self, stub, args):
    if self is TestCase.EMPTY_UNARY:
      _empty_unary(stub)
    elif self is TestCase.LARGE_UNARY:
      _large_unary(stub)
    elif self is TestCase.SERVER_STREAMING:
      _server_streaming(stub)
    elif self is TestCase.CLIENT_STREAMING:
      _client_streaming(stub)
    elif self is TestCase.PING_PONG:
      _ping_pong(stub)
    elif self is TestCase.CANCEL_AFTER_BEGIN:
      _cancel_after_begin(stub)
    elif self is TestCase.CANCEL_AFTER_FIRST_RESPONSE:
      _cancel_after_first_response(stub)
    elif self is TestCase.TIMEOUT_ON_SLEEPING_SERVER:
      _timeout_on_sleeping_server(stub)
    elif self is TestCase.EMPTY_STREAM:
      _empty_stream(stub)
    elif self is TestCase.STATUS_CODE_AND_MESSAGE:
      _status_code_and_message(stub)
    elif self is TestCase.COMPUTE_ENGINE_CREDS:
      _compute_engine_creds(stub, args)
    elif self is TestCase.OAUTH2_AUTH_TOKEN:
      _oauth2_auth_token(stub, args)
    elif self is TestCase.JWT_TOKEN_CREDS:
      _jwt_token_creds(stub, args)
    elif self is TestCase.PER_RPC_CREDS:
      _per_rpc_creds(stub, args)
    else:
      raise NotImplementedError('Test case "%s" not implemented!' % self.name)
