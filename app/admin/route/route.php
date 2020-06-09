<?php

use think\facade\Route;

Route::post('auth/login', 'auth/login');
Route::get('test', 'test/index');
Route::group(function () {
    Route::post('auth/logout', 'auth/logout');
    Route::get('list/article', 'index/article');
    Route::get('user/info', 'user/info');
    //系统用户
    Route::get('systemUser', 'systemUser/index');
    Route::post('systemUser', 'systemUser/add');
    Route::put('systemUser/:id', 'systemUser/edit');
    //角色
    Route::get('role', 'role/index');
    Route::post('role', 'role/add');
    Route::put('role/:id', 'role/edit');
    Route::delete('role/:id', 'role/del');
    //车型
    Route::get('car', 'car/index');
    Route::post('car', 'car/add');
    Route::put('car/:id', 'car/edit');
    Route::delete('car/:id', 'car/del');
    //拆装件
    Route::get('OnOffGood', 'OnOffGood/index');
    Route::post('OnOffGood', 'OnOffGood/add');
    Route::put('OnOffGood/:id', 'OnOffGood/edit');
    Route::delete('OnOffGood/:id', 'OnOffGood/del');
    //大件
    Route::get('LargeGood', 'LargeGood/index');
    Route::post('LargeGood', 'LargeGood/add');
    Route::put('LargeGood/:id', 'LargeGood/edit');
    Route::delete('LargeGood/:id', 'LargeGood/del');
    //居民搬家订单
    Route::get('ResidentOrder', 'ResidentOrder/index');
    //基础数据
    Route::get('common/getRoles', 'common/getRoles');
})->middleware(\app\middleware\AuthTokenMiddleware::class, true);;
