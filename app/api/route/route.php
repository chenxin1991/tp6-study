<?php

use think\facade\Route;

Route::post('user/login', 'user/login');
Route::get('category', 'category/index');
Route::group(function () {
    Route::post('ResidentOrder/add', 'ResidentOrder/add');
    Route::post('category/uploadImage', 'category/uploadImage');
    Route::get('user/detail', 'user.index/detail');
    Route::get('user/order/list/:type', 'user.order/list');
    Route::get('user/order/detail/:id', 'user.order/detail');
})->middleware(\app\middleware\WechatMiddleware::class, true);;
