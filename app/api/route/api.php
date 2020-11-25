<?php
/**
 *
 * User: sun.yaopeng
 * Date: 2020/11/24
 */

use app\api\middleware\Auth;
use think\facade\Route;

Route::post('sms_code', 'sms/code');
Route::post('login', 'login/index');

Route::group(function () {
    Route::get('user_info', 'user/info');
    Route::put('user_update', 'user/update');
})->middleware(Auth::class);
