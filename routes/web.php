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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('login', 'App\Http\Controllers\LoginController');
Route::resource('register', 'App\Http\Controllers\RegisterController');
Auth::routes();

// Prefijo para las rutas de administración
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/adminPanel', [App\Http\Controllers\HomeController::class, 'adminPanel'])->name('adminPanel');
    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('motos', [App\Http\Controllers\Admin\MotoController::class, 'index'])->name('motos.index');
    Route::get('servicios', [App\Http\Controllers\Admin\ServicioController::class, 'index'])->name('servicios.index');
});

// Prefijo para las rutas de cliente
Route::prefix('clientes')->middleware('auth')->group(function () {
    Route::get('/clientPanel', 'App\Http\Controllers\ClientController@clientPanel')->name('clientes.clientPanel');
});
