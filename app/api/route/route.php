<?php

use think\facade\Route;

Route::post('user/login', 'user/login');
Route::post('user/bindPhone', 'user/bindPhone');
Route::get('category', 'category/index');
Route::get('carCategory', 'carCategory/index');
Route::get('driver/order/qrcode', 'driver.order/qrcode');
Route::post('user/order/replyNotify','user.order/replyNotify');
Route::group(function () {
    Route::post('ResidentOrder/add', 'ResidentOrder/add');
    Route::post('category/uploadImage', 'category/uploadImage');
    Route::get('user/detail', 'user.index/detail');
    Route::get('user/order/list/:type', 'user.order/list');
    Route::get('driver/order/list/:type', 'driver.order/list');
    Route::get('user/order/detail/:id', 'user.order/detail');
    Route::post('user/order/cancel/:id', 'user.order/cancel');
    Route::post('user/order/signIn/:id', 'user.order/signIn');
    Route::post('user/order/modifyTotalCost/:id', 'user.order/modifyTotalCost');
    Route::get('driver/order/payUrl/:id', 'driver.order/payUrl');
    Route::post('user/unbindPhone', 'user/unbindPhone');
})->middleware(\app\middleware\WechatMiddleware::class, true);
