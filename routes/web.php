<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavController;
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

Route::get('/home', [NavController::class, 'home'])->name('home');
Route::get('/games', [NavController::class, 'Games'])->name('games');