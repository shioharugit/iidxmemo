<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('App\Http\Controllers')->group(function () {

    // ユーザー
    Route::namespace('User')->name('user.')->group(function () {

        Route::namespace('Auth')->group(function () {
            // ログイン
            Route::get('login', 'LoginController@showLoginForm')->name('login');
            Route::post('login', 'LoginController@login')->name('login');

            // ログアウト
            Route::get('logout', 'LoginController@logout')->name('logout');

            // リマインダ
            Route::get('password', 'ForgotPasswordController@showLinkRequestForm')->name('password');
            Route::post('password', 'ForgotPasswordController@sendResetLinkEmail')->name('password');

            // パスワード再設定メール送信
            Route::post('password/reset', 'ResetPasswordController@reset');

            // パスワード再設定
            Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
            Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
        });

        // ログイン認証後
        Route::middleware('auth:user')->group(function () {
            // TOPページ
            Route::resource('home', 'HomeController', ['only' => 'index']);
        });

    });

    // 管理
    Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

        Route::namespace('Auth')->group(function () {
            // ログイン
            Route::get('login', 'LoginController@showLoginForm')->name('login');
            Route::post('login', 'LoginController@login')->name('login');

            // ログアウト
            Route::get('logout', 'LoginController@logout')->name('logout');

            // リマインダ
            Route::get('password', 'ForgotPasswordController@showLinkRequestForm')->name('password');
            Route::post('password', 'ForgotPasswordController@sendResetLinkEmail')->name('password');

            // パスワード再設定メール送信
            Route::post('password/reset', 'ResetPasswordController@reset');

            // パスワード再設定
            Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
            Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
        });

        // ログイン認証後
        Route::middleware('auth:admin')->group(function () {
            // TOPページ
            Route::resource('home', 'HomeController', ['only' => 'index']);
        });

    });

});
