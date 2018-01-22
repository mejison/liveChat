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

Route::group([
    'middleware' => 'api'
], function ($router) {

    Route::post('login', '\App\Http\Controllers\AuthController@login');
    Route::post('register', '\App\Http\Controllers\AuthController@register');
    Route::post('logout', '\App\Http\Controllers\AuthController@logout');
    Route::post('refresh', '\App\Http\Controllers\AuthController@refresh');
    Route::post('me', '\App\Http\Controllers\AuthController@me');

    Route::get('/user', function(){
        if (auth()->user()) {
            return \App\User::find(auth()->user()->id);
        }
    });
    
    Route::get('/messages', 'ChatController@messagesGet');
    Route::post('/attachFile', 'ChatController@attachFile');
    Route::post('/messages', 'ChatController@messagesPost');
});
