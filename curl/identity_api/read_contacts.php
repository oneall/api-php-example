<?php
/**
 * Copyright 2017 OneAll, LLC.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 *
 */

// HTTP Handler and Configuration
include '../assets/config.php';

// Read contacts of an identity
// https://docs.oneall.com/api/resources/identities/read-contacts/

// The identity to read the contacts for
$identity_token = '9b00dce7-7bd5-4356-947f-37190b673162';

// Read the contacts from cache?
$disable_cache = false;

// The page to retrieve
$page = 1;

// Entries per page
$entries_per_page = 200;

// Newest first
$order_direction = 'asc';

// Make Request
$oneall_curly->get(SITE_DOMAIN . "/identities/" . $identity_token . "/contacts.json?disable_cache=" . ($disable_cache ? "true" : "false") . "&page=" . $page . "&entries_per_page=" . $entries_per_page . "&order_direction=" . $order_direction);
$result = $oneall_curly->get_result();

// Success (Cache)
if ($result->http_code == 200)
{
    echo "<h1>Success " . $result->http_code . " (Contacts Retrieved From Cache)</h1>";
    echo "<pre>" . oneall_pretty_json::format_string($result->body) . "</pre>";
}
// Success (No Cache)
elseif ($result->http_code == 203)
{
    echo "<h1>Success " . $result->http_code . " (Contacts Retrieved From Social Network, Cache Updated)</h1>";
    echo "<pre>" . oneall_pretty_json::format_string($result->body) . "</pre>";
}
// Error
else
{
    echo "<h1>Error " . $result->http_code . "</h1>";
    echo "<pre>" . oneall_pretty_json::format_string($result->body) . "</pre>";
}