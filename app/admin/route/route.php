<?php

use think\facade\Route;

Route::post('auth/login', 'auth/login');
Route::get('test', 'test/index');
Route::group(function () {
    Route::get('list/article', 'index/article');
    Route::get('user/info', 'user/info');
    Route::get('systemUser', 'systemUser/index');
    Route::post('systemUser', 'systemUser/add');
    Route::put('systemUser/:id', 'systemUser/edit');
    Route::get('role', 'role/index');
    Route::post('role', 'role/add');
    Route::put('role/:id', 'role/edit');
    Route::delete('role/:id', 'role/del');
    Route::post('auth/logout', 'auth/logout');
    Route::get('common/getRoles', 'common/getRoles');
})->middleware(\app\middleware\AuthTokenMiddleware::class, true);;
