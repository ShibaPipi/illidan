<?php
/**
 *
 * Created By 皮神
 * Date: 2020/11/24
 */

use app\api\middleware\Auth;
use think\facade\Route;

Route::post('sms_code', 'Sms/code');
Route::post('login', 'Login/index');
Route::get('category$', 'Category/Index');

Route::group(function () {
    Route::get('logout', 'Logout/index');
    Route::get('user_info', 'User/info');
    Route::put('user_update', 'User/update');
})->middleware(Auth::class);
