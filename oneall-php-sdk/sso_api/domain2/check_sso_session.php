<?php
/**
 * Copyright 2011-2017 OneAll, LLC.
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
include '../../../bootstrap.php';

// SSO Realm (If changed, they have also to be modified in start_sso_session.php on domain1)
$top_realm = 'vegetables';
$sub_realm = 'tomato';

?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8" />
			<title>SSO Login Test</title>
			<script type="text/javascript">

				// Compute the callback_uri
				var pathname = window.location.pathname;
				var dir = pathname.substring(0, pathname.lastIndexOf('/'));
				var protocol = window.location.protocol;
				var path = protocol + '//' + window.location.host + dir + '/';
				var callback_uri = path + 'callback_handler.php';

                //Include SSO
				var _oneall = window._oneall || [];
				_oneall.push(['single_sign_on', 'set_callback_uri', callback_uri]);
				_oneall.push(['single_sign_on', 'set_sso_realm', '<?php echo $top_realm; ?>', '<?php echo $sub_realm; ?>']);
				_oneall.push(['single_sign_on', 'do_check_for_sso_session']);

				<!-- Include library.js //-->
				(function() {
					var oa = document.createElement('script');
					oa.type = 'text/javascript'; oa.async = true;
					oa.src = '<?php echo SITE_DOMAIN; ?>/socialize/library.js';
					var s = document.getElementsByTagName('script')[0];
					s.parentNode.insertBefore(oa, s);
				})();
			</script>
		</head>
		<body>
			<h1 id="status">Detecting SSO Cookie ...</h1>
			<h2><a href="check_sso_session.php">Re-Check for SSO Session</a></h2>
			<script type="text/javascript">
                //Error Message
				setTimeout(function(){document.getElementById('status').innerHTML = 'No SSO Cookie Detected';}, 2000);
			</script>
		</body>
	</html>
