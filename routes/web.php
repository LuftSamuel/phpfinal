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
use App\Http\Controllers\ControladorContacto;
use App\Http\Controllers\ControladorPrincipal;

/*Route::get('/asd', function () {
    return view('crear_articulo_mayor');
});*/

Route::get('/', function () {
    return redirect('/index');
});
Route::get('/index',[ControladorPrincipal::class, 'index']);
Route::get('/index/detalle-producto',[ControladorPrincipal::class, 'detalleProducto']);
Route::get('/index/detalle-producto/{producto}',[ControladorPrincipal::class, 'detalleProducto']);
Route::get('/contacto',[ControladorContacto::class, 'index']);

Route::get('/admin',[ControladorAdmin::class, 'formularioMayor']);

//Route::get('/admin/mayor',[ControladorAdmin::class, 'formularioMayor']);
Route::get('/admin/mayor',[ControladorAdmin::class, 'formularioMayor2']);
Route::post('/admin/crearMayor',[ControladorAdmin::class, 'crearMayor'])->name('admin.mayor.crear');

Route::get('/admin/menor',[ControladorAdmin::class, 'formularioMenor']);
Route::post('/admin/crearMenor',[ControladorAdmin::class, 'crearMenor']);

//Route::get('/admin/detalle-producto',[ControladorAdmin::class, 'detalleProducto']);