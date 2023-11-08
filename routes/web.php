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

Route::resource('profile', 'App\Http\Controllers\ProfileController');

Auth::routes();

// Prefijo para las rutas de administración
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/adminPanel', [App\Http\Controllers\HomeController::class, 'adminPanel'])->name('adminPanel');
    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('motos', [App\Http\Controllers\Admin\MotoController::class, 'index'])->name('motos.index');
    Route::get('mantenimientos', [App\Http\Controllers\Admin\MantenimientoController::class, 'index'])->name('mantenimientos.index');

    Route::resource('user', 'App\Http\Controllers\Admin\UserController');
    Route::resource('moto', 'App\Http\Controllers\Admin\MotoController');
    Route::resource('mantenimiento', 'App\Http\Controllers\Admin\MantenimientoController');

    Route::get('/checkEmail', 'App\Http\Controllers\Admin\UserController@checkEmail')->name('checkEmail');

    Route::delete('/users/deleteMultiple', 'App\Http\Controllers\Admin\UserController@deleteMultiple')->name('users.deleteMultiple');
    Route::delete('/motos/deleteMultiple', 'App\Http\Controllers\Admin\MotoController@deleteMultiple')->name('motos.deleteMultiple');
    Route::delete('/mantenimientos/deleteMultiple', 'App\Http\Controllers\Admin\MantenimientoController@deleteMultiple')->name('mantenimientos.deleteMultiple');

});



// Prefijo para las rutas de cliente
Route::prefix('clientes')->middleware('auth')->group(function () {
    Route::get('/clientPanel', 'App\Http\Controllers\ClientPanelController@clientPanel')->name('clientes.clientPanel');
    Route::get('/clientPanel/fichas/{idMoto}', [App\Http\Controllers\FichaController::class, 'index'])->name('fichas.index');

    Route::resource('clientPanel/motopanel', 'App\Http\Controllers\ClientPanelController');
    Route::resource('ficha', 'App\Http\Controllers\FichaController');

    Route::post('clientes/fichas/{idMoto}/agregarGastos', [App\Http\Controllers\FichaController::class, 'agregarGastos'])->name('fichas.agregarGastos');
    Route::post('clientes/fichas/{idMoto}/sumarKilometraje', [App\Http\Controllers\FichaController::class, 'sumarKilometraje'])->name('fichas.sumarKilometraje');
    Route::post('clientes/fichas/{idMoto}/updateCampos/{field}', [App\Http\Controllers\FichaController::class, 'updateCampos'])->name('fichas.updateCampos');
    Route::post('clientes/fichas/updateKilometrajeMultiple/{idMoto}', [App\Http\Controllers\FichaController::class, 'updateKilometrajeMultiple'])->name('fichas.updateKilometrajeMultiple');

});
