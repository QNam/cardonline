<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('/card/register', 'App\Http\Controllers\AuthController@register');
Route::post('/card/login', 'App\Http\Controllers\AuthController@Login');
Route::post('/card/exists', 'App\Http\Controllers\CardController@cardIsExists');
Route::get('/card/getList', 'App\Http\Controllers\CardController@getListCard');
Route::post('/card', 'App\Http\Controllers\CardController@storeCard');
Route::get('/card/getById', 'App\Http\Controllers\CardController@getById');
Route::post('/card/remove', 'App\Http\Controllers\CardController@removeCard');

Route::post('/media/uploadImage', 'App\Http\Controllers\MediaController@uploadImage');