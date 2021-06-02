<?php

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

Route::group([
    'domain' => env('SUB_DOMAIN'),
    'namespace' => 'Admin',
    'prefix' => 'v1'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('forgot-password', 'AuthController@forgotPassword');
        Route::group([
            'middleware' => 'auth:api'
        ], function () {
            // Authentication
            Route::get('logout', 'AuthController@logout');
            Route::get('profile', 'AuthController@profile');
            Route::put('profile/{id}', 'AuthController@updateProfile');
            Route::post('change-password', 'AuthController@changePassword');
        });
    });
