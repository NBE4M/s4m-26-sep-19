/*
 *
 * Copyright 2016, Google Inc.
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
/* Automatically generated nanopb header */
/* Generated by nanopb-0.3.5-dev */

#ifndef GRPC_CORE_EXT_LB_POLICY_GRPCLB_PROTO_GRPC_LB_V1_LOAD_BALANCER_PB_H
#define GRPC_CORE_EXT_LB_POLICY_GRPCLB_PROTO_GRPC_LB_V1_LOAD_BALANCER_PB_H
#include "third_party/nanopb/pb.h"
#if PB_PROTO_HEADER_VERSION != 30
#error Regenerate this file with the current version of nanopb generator.
#endif

#ifdef __cplusplus
extern "C" {
#endif

/* Struct definitions */
typedef struct _grpc_lb_v1_ClientStats {
    bool has_total_requests;
    int64_t total_requests;
    bool has_client_rpc_errors;
    int64_t client_rpc_errors;
    bool has_dropped_requests;
    int64_t dropped_requests;
} grpc_lb_v1_ClientStats;

typedef struct _grpc_lb_v1_Duration {
    bool has_seconds;
    int64_t seconds;
    bool has_nanos;
    int32_t nanos;
} grpc_lb_v1_Duration;

typedef struct _grpc_lb_v1_InitialLoadBalanceRequest {
    bool has_name;
    char name[128];
} grpc_lb_v1_InitialLoadBalanceRequest;

typedef struct _grpc_lb_v1_Server {
    bool has_ip_address;
    char ip_address[46];
    bool has_port;
    int32_t port;
    bool has_load_balance_token;
    char load_balance_token[64];
    bool has_drop_request;
    bool drop_request;
} grpc_lb_v1_Server;

typedef struct _grpc_lb_v1_InitialLoadBalanceResponse {
    bool has_load_balancer_delegate;
    char load_balancer_delegate[64];
    bool has_client_stats_report_interval;
    grpc_lb_v1_Duration client_stats_report_interval;
} grpc_lb_v1_InitialLoadBalanceResponse;

typedef struct _grpc_lb_v1_LoadBalanceRequest {
    bool has_initial_request;
    grpc_lb_v1_InitialLoadBalanceRequest initial_request;
    bool has_client_stats;
    grpc_lb_v1_ClientStats client_stats;
} grpc_lb_v1_LoadBalanceRequest;

typedef struct _grpc_lb_v1_ServerList {
    pb_callback_t servers;
    bool has_expiration_interval;
    grpc_lb_v1_Duration expiration_interval;
} grpc_lb_v1_ServerList;

typedef struct _grpc_lb_v1_LoadBalanceResponse {
    bool has_initial_response;
    grpc_lb_v1_InitialLoadBalanceResponse initial_response;
    bool has_server_list;
    grpc_lb_v1_ServerList server_list;
} grpc_lb_v1_LoadBalanceResponse;

/* Default values for struct fields */

/* Initializer values for message structs */
#define grpc_lb_v1_Duration_init_default         {false, 0, false, 0}
#define grpc_lb_v1_LoadBalanceRequest_init_default {false, grpc_lb_v1_InitialLoadBalanceRequest_init_default, false, grpc_lb_v1_ClientStats_init_default}
#define grpc_lb_v1_InitialLoadBalanceRequest_init_default {false, ""}
#define grpc_lb_v1_ClientStats_init_default      {false, 0, false, 0, false, 0}
#define grpc_lb_v1_LoadBalanceResponse_init_default {false, grpc_lb_v1_InitialLoadBalanceResponse_init_default, false, grpc_lb_v1_ServerList_init_default}
#define grpc_lb_v1_InitialLoadBalanceResponse_init_default {false, "", false, grpc_lb_v1_Duration_init_default}
#define grpc_lb_v1_ServerList_init_default       {{{NULL}, NULL}, false, grpc_lb_v1_Duration_init_default}
#define grpc_lb_v1_Server_init_default           {false, "", false, 0, false, "", false, 0}
#define grpc_lb_v1_Duration_init_zero            {false, 0, false, 0}
#define grpc_lb_v1_LoadBalanceRequest_init_zero  {false, grpc_lb_v1_InitialLoadBalanceRequest_init_zero, false, grpc_lb_v1_ClientStats_init_zero}
#define grpc_lb_v1_InitialLoadBalanceRequest_init_zero {false, ""}
#define grpc_lb_v1_ClientStats_init_zero         {false, 0, false, 0, false, 0}
#define grpc_lb_v1_LoadBalanceResponse_init_zero {false, grpc_lb_v1_InitialLoadBalanceResponse_init_zero, false, grpc_lb_v1_ServerList_init_zero}
#define grpc_lb_v1_InitialLoadBalanceResponse_init_zero {false, "", false, grpc_lb_v1_Duration_init_zero}
#define grpc_lb_v1_ServerList_init_zero          {{{NULL}, NULL}, false, grpc_lb_v1_Duration_init_zero}
#define grpc_lb_v1_Server_init_zero              {false, "", false, 0, false, "", false, 0}

/* Field tags (for use in manual encoding/decoding) */
#define grpc_lb_v1_ClientStats_total_requests_tag 1
#define grpc_lb_v1_ClientStats_client_rpc_errors_tag 2
#define grpc_lb_v1_ClientStats_dropped_requests_tag 3
#define grpc_lb_v1_Duration_seconds_tag          1
#define grpc_lb_v1_Duration_nanos_tag            2
#define grpc_lb_v1_InitialLoadBalanceRequest_name_tag 1
#define grpc_lb_v1_Server_ip_address_tag         1
#define grpc_lb_v1_Server_port_tag               2
#define grpc_lb_v1_Server_load_balance_token_tag 3
#define grpc_lb_v1_Server_drop_request_tag       4
#define grpc_lb_v1_InitialLoadBalanceResponse_load_balancer_delegate_tag 2
#define grpc_lb_v1_InitialLoadBalanceResponse_client_stats_report_interval_tag 3
#define grpc_lb_v1_LoadBalanceRequest_initial_request_tag 1
#define grpc_lb_v1_LoadBalanceRequest_client_stats_tag 2
#define grpc_lb_v1_ServerList_servers_tag        1
#define grpc_lb_v1_ServerList_expiration_interval_tag 3
#define grpc_lb_v1_LoadBalanceResponse_initial_response_tag 1
#define grpc_lb_v1_LoadBalanceResponse_server_list_tag 2

/* Struct field encoding specification for nanopb */
extern const pb_field_t grpc_lb_v1_Duration_fields[3];
extern const pb_field_t grpc_lb_v1_LoadBalanceRequest_fields[3];
extern const pb_field_t grpc_lb_v1_InitialLoadBalanceRequest_fields[2];
extern const pb_field_t grpc_lb_v1_ClientStats_fields[4];
extern const pb_field_t grpc_lb_v1_LoadBalanceResponse_fields[3];
extern const pb_field_t grpc_lb_v1_InitialLoadBalanceResponse_fields[3];
extern const pb_field_t grpc_lb_v1_ServerList_fields[3];
extern const pb_field_t grpc_lb_v1_Server_fields[5];

/* Maximum encoded size of messages (where known) */
#define grpc_lb_v1_Duration_size                 22
#define grpc_lb_v1_LoadBalanceRequest_size       169
#define grpc_lb_v1_InitialLoadBalanceRequest_size 131
#define grpc_lb_v1_ClientStats_size              33
#define grpc_lb_v1_LoadBalanceResponse_size      (98 + grpc_lb_v1_ServerList_size)
#define grpc_lb_v1_InitialLoadBalanceResponse_size 90
#define grpc_lb_v1_Server_size                   127

/* Message IDs (where set with "msgid" option) */
#ifdef PB_MSGID

#define LOAD_BALANCER_MESSAGES \


#endif

#ifdef __cplusplus
} /* extern "C" */
#endif

#endif
