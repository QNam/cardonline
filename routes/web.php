<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect()->route('Login');
});

Route::get('/login',  function(){
    return view('enduser/app');
})->name('Login');

Route::get('/register',  function(){
    return view('enduser/app');
})->name('Register');

Route::middleware(['web'])->group(function () {
    Route::get('/edit/{id}',  function(){
        return view('enduser/app');
    })->name('EditUser');
});

Route::get('/saveToPhone/{id}', 'App\Http\Controllers\CardController@saveProfileToPhone')->name('SaveToPhone');

// Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::get('/quantri/{any?}', App\Http\Controllers\Admin\DashboardController::class);

Route::get('/{any?}', 'App\Http\Controllers\CardController@profile')->name('Profile');

// Route::get('/quantri', 'App\Http\Controllers\Admin\DashboardController@index');

