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

#include <grpc++/support/string_ref.h>

#include <string.h>

#include <gtest/gtest.h>

namespace grpc {
namespace {

const char kTestString[] = "blah";
const char kTestStringWithEmbeddedNull[] = "blah\0foo";
const size_t kTestStringWithEmbeddedNullLength = 8;
const char kTestUnrelatedString[] = "foo";

class StringRefTest : public ::testing::Test {};

TEST_F(StringRefTest, Empty) {
  string_ref s;
  EXPECT_EQ(0U, s.length());
  EXPECT_EQ(nullptr, s.data());
}

TEST_F(StringRefTest, FromCString) {
  string_ref s(kTestString);
  EXPECT_EQ(strlen(kTestString), s.length());
  EXPECT_EQ(kTestString, s.data());
}

TEST_F(StringRefTest, FromCStringWithLength) {
  string_ref s(kTestString, 2);
  EXPECT_EQ(2U, s.length());
  EXPECT_EQ(kTestString, s.data());
}

TEST_F(StringRefTest, FromString) {
  string copy(kTestString);
  string_ref s(copy);
  EXPECT_EQ(copy.data(), s.data());
  EXPECT_EQ(copy.length(), s.length());
}

TEST_F(StringRefTest, CopyConstructor) {
  string_ref s1(kTestString);
  ;
  string_ref s2(s1);
  EXPECT_EQ(s1.length(), s2.length());
  EXPECT_EQ(s1.data(), s2.data());
}

TEST_F(StringRefTest, FromStringWithEmbeddedNull) {
  string copy(kTestStringWithEmbeddedNull, kTestStringWithEmbeddedNullLength);
  string_ref s(copy);
  EXPECT_EQ(copy.data(), s.data());
  EXPECT_EQ(copy.length(), s.length());
  EXPECT_EQ(kTestStringWithEmbeddedNullLength, s.length());
}

TEST_F(StringRefTest, Assignment) {
  string_ref s1(kTestString);
  ;
  string_ref s2;
  EXPECT_EQ(nullptr, s2.data());
  s2 = s1;
  EXPECT_EQ(s1.length(), s2.length());
  EXPECT_EQ(s1.data(), s2.data());
}

TEST_F(StringRefTest, Iterator) {
  string_ref s(kTestString);
  size_t i = 0;
  for (auto it = s.cbegin(); it != s.cend(); ++it) {
    auto val = kTestString[i++];
    EXPECT_EQ(val, *it);
  }
  EXPECT_EQ(strlen(kTestString), i);
}

TEST_F(StringRefTest, ReverseIterator) {
  string_ref s(kTestString);
  size_t i = strlen(kTestString);
  for (auto rit = s.crbegin(); rit != s.crend(); ++rit) {
    auto val = kTestString[--i];
    EXPECT_EQ(val, *rit);
  }
  EXPECT_EQ(0U, i);
}

TEST_F(StringRefTest, Capacity) {
  string_ref empty;
  EXPECT_EQ(0U, empty.length());
  EXPECT_EQ(0U, empty.size());
  EXPECT_EQ(0U, empty.max_size());
  EXPECT_TRUE(empty.empty());

  string_ref s(kTestString);
  EXPECT_EQ(strlen(kTestString), s.length());
  EXPECT_EQ(s.length(), s.size());
  EXPECT_EQ(s.max_size(), s.length());
  EXPECT_FALSE(s.empty());
}

TEST_F(StringRefTest, Compare) {
  string_ref s1(kTestString);
  string s1_copy(kTestString);
  string_ref s2(kTestUnrelatedString);
  string_ref s3(kTestStringWithEmbeddedNull, kTestStringWithEmbeddedNullLength);
  EXPECT_EQ(0, s1.compare(s1_copy));
  EXPECT_NE(0, s1.compare(s2));
  EXPECT_NE(0, s1.compare(s3));
}

TEST_F(StringRefTest, StartsWith) {
  string_ref s1(kTestString);
  string_ref s2(kTestUnrelatedString);
  string_ref s3(kTestStringWithEmbeddedNull, kTestStringWithEmbeddedNullLength);
  EXPECT_TRUE(s1.starts_with(s1));
  EXPECT_FALSE(s1.starts_with(s2));
  EXPECT_FALSE(s2.starts_with(s1));
  EXPECT_FALSE(s1.starts_with(s3));
  EXPECT_TRUE(s3.starts_with(s1));
}

TEST_F(StringRefTest, Endswith) {
  string_ref s1(kTestString);
  string_ref s2(kTestUnrelatedString);
  string_ref s3(kTestStringWithEmbeddedNull, kTestStringWithEmbeddedNullLength);
  EXPECT_TRUE(s1.ends_with(s1));
  EXPECT_FALSE(s1.ends_with(s2));
  EXPECT_FALSE(s2.ends_with(s1));
  EXPECT_FALSE(s2.ends_with(s3));
  EXPECT_TRUE(s3.ends_with(s2));
}

TEST_F(StringRefTest, Find) {
  string_ref s1(kTestString);
  string_ref s2(kTestUnrelatedString);
  string_ref s3(kTestStringWithEmbeddedNull, kTestStringWithEmbeddedNullLength);
  EXPECT_EQ(0U, s1.find(s1));
  EXPECT_EQ(0U, s2.find(s2));
  EXPECT_EQ(0U, s3.find(s3));
  EXPECT_EQ(string_ref::npos, s1.find(s2));
  EXPECT_EQ(string_ref::npos, s2.find(s1));
  EXPECT_EQ(string_ref::npos, s1.find(s3));
  EXPECT_EQ(0U, s3.find(s1));
  EXPECT_EQ(5U, s3.find(s2));
  EXPECT_EQ(string_ref::npos, s1.find('z'));
  EXPECT_EQ(1U, s2.find('o'));
}

TEST_F(StringRefTest, SubString) {
  string_ref s(kTestStringWithEmbeddedNull, kTestStringWithEmbeddedNullLength);
  string_ref sub1 = s.substr(0, 4);
  EXPECT_EQ(string_ref(kTestString), sub1);
  string_ref sub2 = s.substr(5);
  EXPECT_EQ(string_ref(kTestUnrelatedString), sub2);
}

TEST_F(StringRefTest, ComparisonOperators) {
  string_ref s1(kTestString);
  string_ref s2(kTestUnrelatedString);
  string_ref s3(kTestStringWithEmbeddedNull, kTestStringWithEmbeddedNullLength);
  EXPECT_EQ(s1, s1);
  EXPECT_EQ(s2, s2);
  EXPECT_EQ(s3, s3);
  EXPECT_GE(s1, s1);
  EXPECT_GE(s2, s2);
  EXPECT_GE(s3, s3);
  EXPECT_LE(s1, s1);
  EXPECT_LE(s2, s2);
  EXPECT_LE(s3, s3);
  EXPECT_NE(s1, s2);
  EXPECT_NE(s1, s3);
  EXPECT_NE(s2, s3);
  EXPECT_GT(s3, s1);
  EXPECT_LT(s1, s3);
}

}  // namespace
}  // namespace grpc

int main(int argc, char** argv) {
  ::testing::InitGoogleTest(&argc, argv);
  return RUN_ALL_TESTS();
}
