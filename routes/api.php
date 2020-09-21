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

Route::get('im-a-teapot', 'ImATeapotController@index')->name('im-a-teapot');

Route::group(['prefix' => 'auth'], function () {
    Route::post('token', 'Auth\LoginController@token');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('revoke', 'Auth\LoginController@revoke');
    });

    Route::post('register', 'Auth\RegisterController@register');
    Route::post('confirm', 'Auth\ConfirmPasswordController@confirm');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::apiResource('shopping-lists', 'ShoppingListController');
    Route::apiResource('shopping-lists/{shopping_list}/items', 'ItemController')->only(['index', 'store']);
    Route::apiResource('shopping-lists/{shopping_list}/shares', 'ShoppingListUserController')->parameters(['share' => 'email'])->only(['index', 'store', 'destroy']);
    Route::apiResource('items', 'ItemController')->except(['index', 'store']);
    Route::apiResource('products', 'ProductController')->parameters(['products' => 'product_name']);
    Route::apiResource('units', 'UnitController')->only(['index']);
    Route::patch('user', 'UserController@update')->name('user.update');
    Route::get('user', 'UserController@show')->name('user.show');
});
