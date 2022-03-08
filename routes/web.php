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
use App\Http\Controllers\ControladorLogin;

//las rutas a las que accede el usuario
Route::get('/', function () {
    return redirect('/index');
});

//Route::get('/index',[ControladorPrincipal::class, 'index'])->name('inicio'); //no me deja llamar a esta ruta en cabecera
Route::get('/index',[ControladorPrincipal::class, 'busqueda'])->name('busqueda'); //misma url, no sera confuso?
Route::get('/index/detalle-producto',[ControladorPrincipal::class, 'detalleProducto']);
Route::get('/index/detalle-producto/{id}',[ControladorPrincipal::class, 'detalleProducto'])->name('individual');
Route::get('/contacto',[ControladorContacto::class, 'index'])->name('contacto.mostrar');
Route::post('/contacto',[ControladorContacto::class, 'contacto'])->name('contacto.guardar');

//rutas para que el admin inicie y cierre sesion
Route::get('/login',[ControladorLogin::class, 'login'])->name('login'); //middleware auth redirige a la ruta con nombre login
Route::post('/admin/desloguearse',[ControladorLogin::class, 'desloguearse'])->name('desloguearse');
Route::post('/login',[ControladorLogin::class, 'autenticarse']);

//rutas para el admin
    //esta es la pagina de inicio, todavia no tiene funcion
Route::get('/admin', function () {
    return redirect('/admin/index');
});
Route::get('/admin/index',[ControladorAdmin::class, 'index'])->name('admin.index')->middleware('auth');
    //rutas para crear productos 
Route::get('/admin/mayor',[ControladorAdmin::class, 'formularioMayor'])->name('admin.mayor')->middleware('auth');
Route::post('/admin/crearMayor',[ControladorAdmin::class, 'crearMayor'])->name('admin.mayor.crear')->middleware('auth');
Route::post('/admin/modificarMayor',[ControladorAdmin::class, 'modificarMayor'])->name('admin.mayor.modificar')->middleware('auth');

Route::get('/admin/eliminarPlanta',[ControladorAdmin::class, 'eliminarPlanta'])->name('admin.planta.eliminar')->middleware('auth');

Route::get('/admin/menor',[ControladorAdmin::class, 'formularioMenor'])->name('admin.menor')->middleware('auth');
Route::post('/admin/crearMenor',[ControladorAdmin::class, 'crearMenor'])->name('admin.menor.crear')->middleware('auth');
Route::post('/admin/modificarMenor',[ControladorAdmin::class, 'modificarMenor'])->name('admin.menor.modificar')->middleware('auth');

Route::get('/admin/familia',[ControladorAdmin::class, 'formularioFamilia'])->name('admin.familia')->middleware('auth');
Route::post('/admin/crearFamilia',[ControladorAdmin::class, 'crearFamilia'])->name('admin.familia.crear')->middleware('auth');
Route::get('/admin/borrarFamilia',[ControladorAdmin::class, 'borrarFamilia'])->name('admin.familia.borrar')->middleware('auth');
Route::post('/admin/modificarFamilia',[ControladorAdmin::class, 'modificarFamilia'])->name('admin.familia.modificar')->middleware('auth');

Route::get('/admin/planta',[ControladorAdmin::class, 'formularioPlanta'])->name('admin.planta')->middleware('auth');
Route::get('/admin/modificarPlanta',[ControladorAdmin::class, 'modificarPlanta'])->name('admin.planta.modificar')->middleware('auth');
