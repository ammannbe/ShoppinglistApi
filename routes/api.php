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

Route::get('im-a-teapot', function () {
    $teapot = <<<EOF
                       (
            _           ) )
         _,(_)._        ((      I'm a little teapot
    ___,(_______).        )       short and stout
  ,'__.   /       \    /\_        here is my handle
 /,' /  |""|       \  /  /        here is my spout
| | |   |__|       |,'  /         when I get all steamed up
 \`.|                  /          hear me shout
  `. :           :    /           "tip me over and pout me out!"
    `.            :.,'
      `-.________,-'            - Benji
EOF;

    return response($teapot, 418);
});

Route::group(['prefix' => 'auth'], function () {
    Route::group(['prefix' => 'login'], function () {
        Route::post('refresh', 'Auth\LoginController@refresh')->name('login.refresh')->middleware('auth:api');
        Route::post('', 'Auth\LoginController@login')->name('login');
    });

    Route::group(['prefix' => 'register'], function () {
        Route::post('', 'Auth\RegisterController@register')->name('register');
        Route::get('status', 'Auth\VerificationController@status')->name('verification.status')->middleware('auth:api');
        Route::post('resend', 'Auth\VerificationController@resend')->name('verification.resend')->middleware('auth:api');
        Route::get('verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    });

    Route::group(['prefix' => 'password'], function () {
        Route::post('reset-email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.reset-email');
        Route::post('reset', 'Auth\ResetPasswordController@reset')->name('password.reset');
    });

    Route::post('logout', 'Auth\LoginController@logout');
});

Route::middleware(['auth:api', 'verified'])->group(function () {
    Route::apiResource('shopping-lists', 'ShoppingListController');
    Route::get('shopping-lists/{shopping_list}/items', 'ShoppingListController@items');
    Route::apiResource('shopping-lists/{shopping_list}/users', 'ShoppingListUserController')->only(['index', 'store', 'destroy']);
    Route::apiResource('items', 'ItemController')->only(['store', 'show', 'update', 'destroy']);
    Route::apiResource('products', 'ProductController');
    Route::apiResource('units', 'UnitController')->only(['index']);
    Route::group(['prefix' => 'user'], function () {
        Route::get('', 'UserController@show')->name('user.show');
    });
});
