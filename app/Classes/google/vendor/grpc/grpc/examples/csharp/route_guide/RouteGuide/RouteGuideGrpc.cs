// Generated by the protocol buffer compiler.  DO NOT EDIT!
// source: route_guide.proto
// Original file comments:
// Copyright 2015, Google Inc.
// All rights reserved.
//
// Redistribution and use in source and binary forms, with or without
// modification, are permitted provided that the following conditions are
// met:
//
//     * Redistributions of source code must retain the above copyright
// notice, this list of conditions and the following disclaimer.
//     * Redistributions in binary form must reproduce the above
// copyright notice, this list of conditions and the following disclaimer
// in the documentation and/or other materials provided with the
// distribution.
//     * Neither the name of Google Inc. nor the names of its
// contributors may be used to endorse or promote products derived from
// this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
// "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
// LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
// A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
// OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
// LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
// DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
// THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
// (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
// OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
#region Designer generated code

using System;
using System.Threading;
using System.Threading.Tasks;
using Grpc.Core;

namespace Routeguide {
  /// <summary>
  ///  Interface exported by the server.
  /// </summary>
  public static class RouteGuide
  {
    static readonly string __ServiceName = "routeguide.RouteGuide";

    static readonly Marshaller<global::Routeguide.Point> __Marshaller_Point = Marshallers.Create((arg) => global::Google.Protobuf.MessageExtensions.ToByteArray(arg), global::Routeguide.Point.Parser.ParseFrom);
    static readonly Marshaller<global::Routeguide.Feature> __Marshaller_Feature = Marshallers.Create((arg) => global::Google.Protobuf.MessageExtensions.ToByteArray(arg), global::Routeguide.Feature.Parser.ParseFrom);
    static readonly Marshaller<global::Routeguide.Rectangle> __Marshaller_Rectangle = Marshallers.Create((arg) => global::Google.Protobuf.MessageExtensions.ToByteArray(arg), global::Routeguide.Rectangle.Parser.ParseFrom);
    static readonly Marshaller<global::Routeguide.RouteSummary> __Marshaller_RouteSummary = Marshallers.Create((arg) => global::Google.Protobuf.MessageExtensions.ToByteArray(arg), global::Routeguide.RouteSummary.Parser.ParseFrom);
    static readonly Marshaller<global::Routeguide.RouteNote> __Marshaller_RouteNote = Marshallers.Create((arg) => global::Google.Protobuf.MessageExtensions.ToByteArray(arg), global::Routeguide.RouteNote.Parser.ParseFrom);

    static readonly Method<global::Routeguide.Point, global::Routeguide.Feature> __Method_GetFeature = new Method<global::Routeguide.Point, global::Routeguide.Feature>(
        MethodType.Unary,
        __ServiceName,
        "GetFeature",
        __Marshaller_Point,
        __Marshaller_Feature);

    static readonly Method<global::Routeguide.Rectangle, global::Routeguide.Feature> __Method_ListFeatures = new Method<global::Routeguide.Rectangle, global::Routeguide.Feature>(
        MethodType.ServerStreaming,
        __ServiceName,
        "ListFeatures",
        __Marshaller_Rectangle,
        __Marshaller_Feature);

    static readonly Method<global::Routeguide.Point, global::Routeguide.RouteSummary> __Method_RecordRoute = new Method<global::Routeguide.Point, global::Routeguide.RouteSummary>(
        MethodType.ClientStreaming,
        __ServiceName,
        "RecordRoute",
        __Marshaller_Point,
        __Marshaller_RouteSummary);

    static readonly Method<global::Routeguide.RouteNote, global::Routeguide.RouteNote> __Method_RouteChat = new Method<global::Routeguide.RouteNote, global::Routeguide.RouteNote>(
        MethodType.DuplexStreaming,
        __ServiceName,
        "RouteChat",
        __Marshaller_RouteNote,
        __Marshaller_RouteNote);

    /// <summary>Service descriptor</summary>
    public static global::Google.Protobuf.Reflection.ServiceDescriptor Descriptor
    {
      get { return global::Routeguide.RouteGuideReflection.Descriptor.Services[0]; }
    }

    /// <summary>Base class for server-side implementations of RouteGuide</summary>
    public abstract class RouteGuideBase
    {
      /// <summary>
      ///  A simple RPC.
      ///
      ///  Obtains the feature at a given position.
      ///
      ///  A feature with an empty name is returned if there's no feature at the given
      ///  position.
      /// </summary>
      public virtual global::System.Threading.Tasks.Task<global::Routeguide.Feature> GetFeature(global::Routeguide.Point request, ServerCallContext context)
      {
        throw new RpcException(new Status(StatusCode.Unimplemented, ""));
      }

      /// <summary>
      ///  A server-to-client streaming RPC.
      ///
      ///  Obtains the Features available within the given Rectangle.  Results are
      ///  streamed rather than returned at once (e.g. in a response message with a
      ///  repeated field), as the rectangle may cover a large area and contain a
      ///  huge number of features.
      /// </summary>
      public virtual global::System.Threading.Tasks.Task ListFeatures(global::Routeguide.Rectangle request, IServerStreamWriter<global::Routeguide.Feature> responseStream, ServerCallContext context)
      {
        throw new RpcException(new Status(StatusCode.Unimplemented, ""));
      }

      /// <summary>
      ///  A client-to-server streaming RPC.
      ///
      ///  Accepts a stream of Points on a route being traversed, returning a
      ///  RouteSummary when traversal is completed.
      /// </summary>
      public virtual global::System.Threading.Tasks.Task<global::Routeguide.RouteSummary> RecordRoute(IAsyncStreamReader<global::Routeguide.Point> requestStream, ServerCallContext context)
      {
        throw new RpcException(new Status(StatusCode.Unimplemented, ""));
      }

      /// <summary>
      ///  A Bidirectional streaming RPC.
      ///
      ///  Accepts a stream of RouteNotes sent while a route is being traversed,
      ///  while receiving other RouteNotes (e.g. from other users).
      /// </summary>
      public virtual global::System.Threading.Tasks.Task RouteChat(IAsyncStreamReader<global::Routeguide.RouteNote> requestStream, IServerStreamWriter<global::Routeguide.RouteNote> responseStream, ServerCallContext context)
      {
        throw new RpcException(new Status(StatusCode.Unimplemented, ""));
      }

    }

    /// <summary>Client for RouteGuide</summary>
    public class RouteGuideClient : ClientBase<RouteGuideClient>
    {
      /// <summary>Creates a new client for RouteGuide</summary>
      /// <param name="channel">The channel to use to make remote calls.</param>
      public RouteGuideClient(Channel channel) : base(channel)
      {
      }
      /// <summary>Creates a new client for RouteGuide that uses a custom <c>CallInvoker</c>.</summary>
      /// <param name="callInvoker">The callInvoker to use to make remote calls.</param>
      public RouteGuideClient(CallInvoker callInvoker) : base(callInvoker)
      {
      }
      /// <summary>Protected parameterless constructor to allow creation of test doubles.</summary>
      protected RouteGuideClient() : base()
      {
      }
      /// <summary>Protected constructor to allow creation of configured clients.</summary>
      /// <param name="configuration">The client configuration.</param>
      protected RouteGuideClient(ClientBaseConfiguration configuration) : base(configuration)
      {
      }

      /// <summary>
      ///  A simple RPC.
      ///
      ///  Obtains the feature at a given position.
      ///
      ///  A feature with an empty name is returned if there's no feature at the given
      ///  position.
      /// </summary>
      public virtual global::Routeguide.Feature GetFeature(global::Routeguide.Point request, Metadata headers = null, DateTime? deadline = null, CancellationToken cancellationToken = default(CancellationToken))
      {
        return GetFeature(request, new CallOptions(headers, deadline, cancellationToken));
      }
      /// <summary>
      ///  A simple RPC.
      ///
      ///  Obtains the feature at a given position.
      ///
      ///  A feature with an empty name is returned if there's no feature at the given
      ///  position.
      /// </summary>
      public virtual global::Routeguide.Feature GetFeature(global::Routeguide.Point request, CallOptions options)
      {
        return CallInvoker.BlockingUnaryCall(__Method_GetFeature, null, options, request);
      }
      /// <summary>
      ///  A simple RPC.
      ///
      ///  Obtains the feature at a given position.
      ///
      ///  A feature with an empty name is returned if there's no feature at the given
      ///  position.
      /// </summary>
      public virtual AsyncUnaryCall<global::Routeguide.Feature> GetFeatureAsync(global::Routeguide.Point request, Metadata headers = null, DateTime? deadline = null, CancellationToken cancellationToken = default(CancellationToken))
      {
        return GetFeatureAsync(request, new CallOptions(headers, deadline, cancellationToken));
      }
      /// <summary>
      ///  A simple RPC.
      ///
      ///  Obtains the feature at a given position.
      ///
      ///  A feature with an empty name is returned if there's no feature at the given
      ///  position.
      /// </summary>
      public virtual AsyncUnaryCall<global::Routeguide.Feature> GetFeatureAsync(global::Routeguide.Point request, CallOptions options)
      {
        return CallInvoker.AsyncUnaryCall(__Method_GetFeature, null, options, request);
      }
      /// <summary>
      ///  A server-to-client streaming RPC.
      ///
      ///  Obtains the Features available within the given Rectangle.  Results are
      ///  streamed rather than returned at once (e.g. in a response message with a
      ///  repeated field), as the rectangle may cover a large area and contain a
      ///  huge number of features.
      /// </summary>
      public virtual AsyncServerStreamingCall<global::Routeguide.Feature> ListFeatures(global::Routeguide.Rectangle request, Metadata headers = null, DateTime? deadline = null, CancellationToken cancellationToken = default(CancellationToken))
      {
        return ListFeatures(request, new CallOptions(headers, deadline, cancellationToken));
      }
      /// <summary>
      ///  A server-to-client streaming RPC.
      ///
      ///  Obtains the Features available within the given Rectangle.  Results are
      ///  streamed rather than returned at once (e.g. in a response message with a
      ///  repeated field), as the rectangle may cover a large area and contain a
      ///  huge number of features.
      /// </summary>
      public virtual AsyncServerStreamingCall<global::Routeguide.Feature> ListFeatures(global::Routeguide.Rectangle request, CallOptions options)
      {
        return CallInvoker.AsyncServerStreamingCall(__Method_ListFeatures, null, options, request);
      }
      /// <summary>
      ///  A client-to-server streaming RPC.
      ///
      ///  Accepts a stream of Points on a route being traversed, returning a
      ///  RouteSummary when traversal is completed.
      /// </summary>
      public virtual AsyncClientStreamingCall<global::Routeguide.Point, global::Routeguide.RouteSummary> RecordRoute(Metadata headers = null, DateTime? deadline = null, CancellationToken cancellationToken = default(CancellationToken))
      {
        return RecordRoute(new CallOptions(headers, deadline, cancellationToken));
      }
      /// <summary>
      ///  A client-to-server streaming RPC.
      ///
      ///  Accepts a stream of Points on a route being traversed, returning a
      ///  RouteSummary when traversal is completed.
      /// </summary>
      public virtual AsyncClientStreamingCall<global::Routeguide.Point, global::Routeguide.RouteSummary> RecordRoute(CallOptions options)
      {
        return CallInvoker.AsyncClientStreamingCall(__Method_RecordRoute, null, options);
      }
      /// <summary>
      ///  A Bidirectional streaming RPC.
      ///
      ///  Accepts a stream of RouteNotes sent while a route is being traversed,
      ///  while receiving other RouteNotes (e.g. from other users).
      /// </summary>
      public virtual AsyncDuplexStreamingCall<global::Routeguide.RouteNote, global::Routeguide.RouteNote> RouteChat(Metadata headers = null, DateTime? deadline = null, CancellationToken cancellationToken = default(CancellationToken))
      {
        return RouteChat(new CallOptions(headers, deadline, cancellationToken));
      }
      /// <summary>
      ///  A Bidirectional streaming RPC.
      ///
      ///  Accepts a stream of RouteNotes sent while a route is being traversed,
      ///  while receiving other RouteNotes (e.g. from other users).
      /// </summary>
      public virtual AsyncDuplexStreamingCall<global::Routeguide.RouteNote, global::Routeguide.RouteNote> RouteChat(CallOptions options)
      {
        return CallInvoker.AsyncDuplexStreamingCall(__Method_RouteChat, null, options);
      }
      protected override RouteGuideClient NewInstance(ClientBaseConfiguration configuration)
      {
        return new RouteGuideClient(configuration);
      }
    }

    /// <summary>Creates service definition that can be registered with a server</summary>
    public static ServerServiceDefinition BindService(RouteGuideBase serviceImpl)
    {
      return ServerServiceDefinition.CreateBuilder()
          .AddMethod(__Method_GetFeature, serviceImpl.GetFeature)
          .AddMethod(__Method_ListFeatures, serviceImpl.ListFeatures)
          .AddMethod(__Method_RecordRoute, serviceImpl.RecordRoute)
          .AddMethod(__Method_RouteChat, serviceImpl.RouteChat).Build();
    }

  }
}
#endregion
