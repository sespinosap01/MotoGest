<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
Route::get('/home/user', [App\Http\Controllers\HomeController::class, 'user'])->name('user');

Route::resource('login', 'App\Http\Controllers\LoginController');
Route::resource('register', 'App\Http\Controllers\RegisterController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();