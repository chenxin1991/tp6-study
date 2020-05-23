<?php

use think\facade\Route;

Route::post('auth/login', 'auth/login');
Route::group(function () {
    Route::get('list/article', 'index/article');
    Route::get('user/info', 'user/info');
    Route::post('auth/logout', 'auth/logout');
})->middleware(\app\middleware\AuthTokenMiddleware::class, true);;
