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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('loginAdmin');
Route::post('/admin/login', [\App\Http\Controllers\AdminController::class, 'login'])->name('loginAdminPost');

Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'indexAdmin'])->name('DashboardIndex');

Route::get('/admin/dashboard/inmuebles', [\App\Http\Controllers\InmuebleController::class, 'index'])->name('InmueblesIndex');
Route::post('/admin/dashboard/inmuebles', [\App\Http\Controllers\InmuebleController::class, 'save'])->name('InmueblesSave');
Route::put('/admin/dashboard/inmueble/{inmueble}', [\App\Http\Controllers\InmuebleController::class, 'update'])->name('InmuebleUpdate');
Route::delete('/admin/dashboard/inmueble/{inmueble}', [\App\Http\Controllers\InmuebleController::class, 'delete'])->name('InmuebleDelete');
Route::post('/admin/dashboard/inmueble/{inmueble}', [\App\Http\Controllers\InmuebleController::class, 'activate'])->name('InmuebleActivate');

Route::get('/admin/dashboard/vehiculos', [\App\Http\Controllers\VehiculoController::class, 'index'])->name('VehiculosIndex');
Route::post('/admin/dashboard/vehiculos', [\App\Http\Controllers\VehiculoController::class, 'save'])->name('VehiculosSave');
Route::put('/admin/dashboard/vehiculo/{vehiculo}', [\App\Http\Controllers\VehiculoController::class, 'update'])->name('VehiculoUpdate');
Route::delete('/admin/dashboard/vehiculo/{vehiculo}', [\App\Http\Controllers\VehiculoController::class, 'delete'])->name('VehiculoDelete');
Route::post('/admin/dashboard/vehiculo/{vehiculo}', [\App\Http\Controllers\VehiculoController::class, 'activate'])->name('VehiculoActivate');

Route::post('/marca/{marca}/modelos', [\App\Http\Controllers\MarcaController::class, 'obtenerModelos'])->name('ObtenerModelos');


Route::get('/publicacion/{publicacion}', [\App\Http\Controllers\PublicacionController::class, 'verPublicacion'])->name('VerPublicacion');

Route::post('/publicacion/{publicacion}/consulta', [\App\Http\Controllers\PublicacionController::class, 'realizarConsulta'])->name('realizarConsulta');


