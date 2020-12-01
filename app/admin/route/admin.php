<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/25
 */

use app\admin\middleware\Auth;
use think\facade\Route;

Route::get('/', function () {
    return url('category');
})->name('index');
Route::get('login','Login/index');
Route::post('login','Login/check');

Route::group(function () {
//    Route::get('/','index/index');
    Route::get('index','Index/index');
    Route::get('welcome','Index/welcome');
    Route::get('logout','Logout/index');
    Route::resource('category','Category');
    Route::get('category/sort','Category/sort');
    Route::get('category/status','Category/status');
    Route::get('category/name','Category/name');
})->middleware(Auth::class);
