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

use App\Http\Controllers\ControladorAdmin;

/*Route::get('/asd', function () {
    return view('crear_articulo_mayor');
});*/

Route::get('/',[App\Http\Controllers\ControladorPrincipal::class, 'index']);
Route::get('/admin',[ControladorAdmin::class, 'index']);
Route::get('/admin/mayor',[ControladorAdmin::class, 'crearMayor']);
Route::get('/admin/menor',[ControladorAdmin::class, 'crearMenor']);
Route::get('/admin/detalle-producto',[ControladorAdmin::class, 'detalleProducto']);