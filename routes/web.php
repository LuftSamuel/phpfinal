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

//las rutas a las que accede el usuario
Route::get('/', function () {
    return redirect('/index');
});
Route::get('/index',[ControladorPrincipal::class, 'index']);
Route::get('/index/detalle-producto',[ControladorPrincipal::class, 'detalleProducto']);
Route::get('/index/detalle-producto/{producto}',[ControladorPrincipal::class, 'detalleProducto']);
Route::get('/contacto',[ControladorContacto::class, 'index']);

//rutas para que el admin inicie y cierre sesion
Route::get('/admin',[ControladorAdmin::class, 'login'])->name('login'); //middleware auth redirige a la ruta con nombre login
Route::post('/admin/desloguearse',[ControladorAdmin::class, 'desloguearse']);
Route::post('/admin',[ControladorAdmin::class, 'autenticarse']);

//rutas para el admin
//esta es la pagina de inicio, todavia no tiene funcion
Route::get('/admin/index',[ControladorAdmin::class, 'index'])->name('admin.index')->middleware('auth');
//rutas para crear productos 
Route::get('/admin/mayor',[ControladorAdmin::class, 'formularioMayor'])->name('admin.mayor')->middleware('auth');
Route::post('/admin/crearMayor',[ControladorAdmin::class, 'crearMayor'])->name('admin.mayor.crear')->middleware('auth');
Route::get('/admin/menor',[ControladorAdmin::class, 'formularioMenor'])->name('admin.menor')->middleware('auth');
Route::post('/admin/crearMenor',[ControladorAdmin::class, 'crearMenor'])->name('admin.menor.crear')->middleware('auth');