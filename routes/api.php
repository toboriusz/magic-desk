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

// Auth routes
Route::group(['prefix' => 'auth'], function () {

    Route::post('login', 'AuthAPIController@login');
    Route::post('register', 'AuthAPIController@register');

    Route::post('verify-email', 'AuthAPIController@verifyEmail');

    Route::post('password-reset/send', 'AuthAPIController@sendResetEmail');
    Route::post('password-reset/update', 'AuthAPIController@resetPassword');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', 'AuthAPIController@logout');
        Route::get('user', 'AuthAPIController@user');
        Route::post('refresh-token', 'AuthAPIController@refreshToken');
    });

});

Route::group(['middleware' => 'auth:api'], function() {

    // Secured routes
});