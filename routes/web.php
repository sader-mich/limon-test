<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\DescuentoController;
use App\Http\Controllers\LogController;

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('users/profile', [UserController::class, 'profile'])->name('users.profile');

Route::get('producers/trace', [ProducerController::class, 'trace'])->name('producers.trace');
Route::post('producers/traces', [ProducerController::class, 'traces'])->name('producers.traces');
Route::put('producers/deliver/{id}', [ProducerController::class, 'deliver'])->name('producers.deliver');
Route::get('/localidades/{id}', [ProducerController::class, 'getLocalidades']);
Route::post('/producers/import',[ProducerController::class,'import'])->name('producers.import');

Route::get('documentos/preregistro', [DocumentoController::class, 'preregistro'])->name('documentos.preregistro');
Route::post('documentos/preregistro_edit', [DocumentoController::class, 'preregistro_edit'])->name('documentos.preregistro_edit');
Route::post('/documentos/import',[DocumentoController::class,'import'])->name('documentos.import');

Route::get('/log', [LogController::class, 'log'])->name('log');

Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'producers' => ProducerController::class,
    'documentos' => DocumentoController::class,
    'descuentos' => DescuentoController::class,
]);
