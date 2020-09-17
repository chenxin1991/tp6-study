<?php

use think\facade\Route;

Route::post('auth/login', 'auth/login');
Route::get('test', 'test/index');
Route::post('test/avatar', 'test/avatar');
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
    //队长
    Route::get('Leader', 'Leader/index');
    Route::post('Leader', 'Leader/add');
    Route::put('Leader/:id', 'Leader/edit');
    Route::delete('Leader/:id', 'Leader/del');
    //参数设置
    Route::get('Setting', 'Setting/detail');
    Route::put('Setting', 'Setting/edit');
    //居民搬家订单
    Route::get('ResidentOrder', 'ResidentOrder/index');
    Route::post('ResidentOrder', 'ResidentOrder/add');
    Route::put('ResidentOrder/:id', 'ResidentOrder/edit');
    Route::delete('ResidentOrder/:id', 'ResidentOrder/del');
    Route::post('ResidentOrder/confirm/:id', 'ResidentOrder/confirm');
    Route::post('ResidentOrder/dispatch/:id', 'ResidentOrder/dispatch');
    Route::post('ResidentOrder/cancel/:id', 'ResidentOrder/cancel');
    //基础数据
    Route::get('common/getRoles', 'common/getRoles');
    Route::get('common/getCars', 'common/getCars');
    Route::get('common/getGoods', 'common/getGoods');
    Route::get('common/getSetting', 'common/getSetting');
    Route::get('common/getLeaders', 'common/getLeaders');
    Route::get('common/getCategory', 'common/getCategory');
    //物品分类
    Route::get('Category', 'Category/index');
    Route::post('Category', 'Category/add');
    Route::put('Category/:id', 'Category/edit');
    Route::delete('Category/:id', 'Category/del');
    //物品
    Route::get('Goods', 'Goods/index');
    Route::post('Goods', 'Goods/add');
    Route::put('Goods/:id', 'Goods/edit');
    Route::delete('Goods/:id', 'Goods/del');
    //微信用户
    Route::get('User', 'User/index');
})->middleware(\app\middleware\AuthTokenMiddleware::class, true);;
