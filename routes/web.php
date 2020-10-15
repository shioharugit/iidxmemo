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

// ROOT
Route::get('/', function () {
    return redirect()->route('user.login');
});

// ユーザー
Route::namespace('User')->prefix('user')->name('user.')->group(function () {

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

    // ユーザー仮登録
    Route::get('preregister', 'UserController@preregister')->name('preregister');
    Route::post('send', 'UserController@send')->name('send');

    // ユーザー登録
    Route::get('create/{email_verify_token}', 'UserController@create')->name('create');
    Route::post('store/{email_verify_token}', 'UserController@store')->name('store');

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {
        // メモ
        Route::prefix('memo')->name('memo.')->group(function () {
            // 一覧
            Route::get('index', 'MemoController@index')->name('index');

            // Ajax メモ取得
            Route::post('list', 'MemoController@list')->name('list');
            // Ajax メモ更新
            Route::post('update/{memo_id}', 'MemoController@update')->name('update');
            // Ajax メモ削除
            Route::post('destroy/{memo_id}', 'MemoController@destroy')->name('destroy');
        });

        // ユーザー更新
        Route::get('edit', 'UserController@edit')->name('edit');
        Route::post('update', 'UserController@update')->name('update');

        // ユーザー退会
        Route::post('destroy', 'UserController@destroy')->name('destroy');
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
        // 楽曲
        Route::prefix('music')->name('music.')->group(function () {
            // 一覧
            Route::get('index', 'MusicController@index')->name('index');

            // 登録
            Route::get('create', 'MusicController@create')->name('create');
            Route::post('store', 'MusicController@store')->name('store');

            // 更新
            Route::get('edit/{music_id}', 'MusicController@edit')->name('edit');
            Route::post('update/{music_id}', 'MusicController@update')->name('update');

            // 削除
            Route::post('destroy/{music_id}', 'MusicController@destroy')->name('destroy');
        });

        // ユーザー
        Route::prefix('user')->name('user.')->group(function () {
            // 一覧
            Route::get('index', 'UserController@index')->name('index');

            // 登録
            Route::get('create', 'UserController@create')->name('create');
            Route::post('store', 'UserController@store')->name('store');

            // 更新
            Route::get('edit/{user_id}', 'UserController@edit')->name('edit');
            Route::post('update/{user_id}', 'UserController@update')->name('update');

            // 削除
            Route::post('destroy/{user_id}', 'UserController@destroy')->name('destroy');
        });
    });

});

