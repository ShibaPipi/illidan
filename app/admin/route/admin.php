<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/25
 */

use app\admin\middleware\Auth;
use think\facade\Route;

Route::get('/', function () {
    return url('category');
})->name('index');
Route::get('login','login/index');
Route::post('login','login/check');

Route::group(function () {
//    Route::get('/','index/index');
    Route::get('index','index/index');
    Route::get('welcome','index/welcome');
    Route::get('logout','logout/index');
    Route::resource('category','Category');
//    Route::get('category/add','category/add');
})->middleware(Auth::class);
