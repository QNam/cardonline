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
Route::post('/media/uploadImageBase64', 'App\Http\Controllers\MediaController@uploadImageBase64');

Route::post('/card/saveAvatar', 'App\Http\Controllers\CardController@saveAvatar');
Route::post('/card/saveBackground', 'App\Http\Controllers\CardController@saveBackground');
Route::post('/card/saveBackgroundBase64', 'App\Http\Controllers\CardController@saveBackgroundBase64');
Route::post('/card/removeLink', 'App\Http\Controllers\CardController@removeCardLink');
Route::post('/card/genCard', 'App\Http\Controllers\CardController@genCard');
Route::post('/card/checkConfirmCode', 'App\Http\Controllers\CardController@checkConfirmCode');
Route::post('/card/checkAccountToForgetPassword', 'App\Http\Controllers\CardController@checkAccountToForgetPassword');
Route::post('/card/forgetPassword', 'App\Http\Controllers\CardController@forgetPassword');

Route::post('/card/updateTickCard', 'App\Http\Controllers\CardController@updateTickCard');

Route::post('/card/storeOneCard', 'App\Http\Controllers\CardController@storeOneCard');