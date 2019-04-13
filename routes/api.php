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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', 'Api\UsersController@index');

Route::middleware('auth')
    ->post('/users/{user}/avatar', 'Api\UserAvatarController@store')
    ->name('avatar');

Route::middleware('auth')
    ->post('/replies/{reply}/best', 'Api\BestRepliesController@store')->name('best-replies.store');
