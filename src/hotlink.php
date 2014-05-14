<?php
/*
------------------------------------------------------------------------------
The MIT License (MIT)

Copyright (c) 2014 jan.klaas.van.den.meersche@ehb.be

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
------------------------------------------------------------------------------
ADDITIONAL NOTE: this script should be used for educational purposes only.
------------------------------------------------------------------------------
*/

if($_SERVER['SERVER_NAME'] != parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) ) exit(invalidBase64());//check if request is local
if(empty($_GET['url'])) exit(invalidBase64());//check if url is passed via GET
$url = $_GET['url'];
if(!filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED )) exit(invalidBase64()); //check if valid url
if($_SERVER['SERVER_NAME'] == parse_url($url, PHP_URL_HOST) ) exit(invalidBase64()); //check if crossdomain call to prevent from reading local files

$user_agent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.65 Safari/537.31";
$referrer = (empty($_GET['referrer']))? '' : $_GET['referrer'];

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent );
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch, CURLOPT_REFERER, $referrer);

$result = curl_exec($ch);
curl_close($ch);

echo base64_encode($result);

function invalidBase64()
{
    return 'iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAIAAAD/gAIDAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDozMTAyQjY4M0NGMEUxMUUzOUMxNEZEMUIwMTlFQTAzMiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDozMTAyQjY4NENGMEUxMUUzOUMxNEZEMUIwMTlFQTAzMiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjMxMDJCNjgxQ0YwRTExRTM5QzE0RkQxQjAxOUVBMDMyIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjMxMDJCNjgyQ0YwRTExRTM5QzE0RkQxQjAxOUVBMDMyIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+YZ18dAAAD5VJREFUeNrsXHtQ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';
}
?>