<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', [NavController::class,'home'])->name('home');
Route::get('/', function () {
    return redirect('/home');
});

Route::controller(NavController::class)->group(function() {
    Route::get('/home','home')->name('home');
    Route::get('/games','Games')->name('games');
    Route::get('/chartGenerators','AiTools')->name('aitools');
    Route::get('/{name}/chartGenerators','GameAiTools')->name('gameAitools');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () { 

    Route::controller(UserController::class)->group(function() {
        
        Route::get('/{name}/history','history')->name('history');
        Route::get('download/chart/{id}', 'downloadChart')->name('download.chart');
        Route::post('/favAitool_flag','favAitool_flag')->name('favAitool_flag');
        Route::post('/favGame_flag','favGame_flag')->name('favGame_flag');
        
    });


});