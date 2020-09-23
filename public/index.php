<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;

require __DIR__ . '/../vendor/autoload.php';

//require_once __DIR__ . "/../app/common/library/php_sdk_v3/lib/WxPay.Api.php";
//require_once __DIR__ . "/../app/common/library/php_sdk_v3/example/WxPay.NativePay.php";
//require_once __DIR__ . "/../app/common/library/php_sdk_v3/example/log.php";


// 执行HTTP应用并响应
$http = (new App())->http;

$response = $http->run();

$response->send();

$http->end($response);
