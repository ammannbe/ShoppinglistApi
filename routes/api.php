<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::group(['prefix' => 'login'], function () {
        Route::post('refresh', 'Auth\LoginController@refresh')->name('login.refresh')->middleware('auth:api');
        Route::post('', 'Auth\LoginController@login')->name('login');
    });

    Route::group(['prefix' => 'register'], function () {
        Route::post('', 'Auth\RegisterController@register')->name('register');
        Route::post('resend', 'Auth\VerificationController@resend')->name('verification.resend');
    });

    Route::group(['prefix' => 'password'], function () {
        Route::post('reset-email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.reset-email');
        Route::post('reset', 'Auth\ResetPasswordController@reset')->name('password.reset');
    });

    Route::post('logout', 'Auth\LoginController@logout');
});
