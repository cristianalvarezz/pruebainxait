<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/ganador',[App\Http\Controllers\Controller::class,'ganador'])->name('ganador');
Route::get('/registro',[App\Http\Controllers\Controller::class,'registro'])->name('registro');
Route::post('/all_departments', [App\Http\Controllers\Controller::class, 'all_departments'])->name('all_departments');
Route::post('/registro_post', [App\Http\Controllers\Controller::class, 'validar_registro'])->name('registro_post');
Route::post('/registro_newpost', [App\Http\Controllers\Controller::class, 'registrouser'])->name('registro_newpost');
Route::get('/excel', [App\Http\Controllers\Controller::class, 'excel'])->name('excel');
Route::post('/generar_ganador', [App\Http\Controllers\Controller::class, 'generar_ganador'])->name('generar_ganador');
Route::get('/volver', [App\Http\Controllers\Controller::class, 'volver'])->name('volver');