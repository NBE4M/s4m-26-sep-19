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

#import <GRPCClient/GRPCCall+Tests.h>

#import "InteropTests.h"

static NSString * const kLocalSSLHost = @"localhost:5051";

/** Tests in InteropTests.m, sending the RPCs to a local SSL server. */
@interface InteropTestsLocalSSL : InteropTests
@end

@implementation InteropTestsLocalSSL

+ (NSString *)host {
  return kLocalSSLHost;
}

- (int32_t)encodingOverhead {
  return 10; // bytes
}

- (void)setUp {
  [super setUp];

  // Register test server certificates and name.
  NSBundle *bundle = [NSBundle bundleForClass:self.class];
  NSString *certsPath = [bundle pathForResource:@"TestCertificates.bundle/test-certificates"
                                         ofType:@"pem"];
  [GRPCCall useTestCertsPath:certsPath testName:@"foo.test.google.fr" forHost:kLocalSSLHost];
}

- (void)testExceptions {
  // Try to set userAgentPrefix for host that is nil. This should cause
  // an exception.
  @try {
    [GRPCCall useTestCertsPath:nil testName:nil forHost:nil];
    XCTFail(@"Did not receive an exception when parameters are nil");
  } @catch(NSException *theException) {
    NSLog(@"Received exception as expected: %@", theException.name);
  }
}

@end
