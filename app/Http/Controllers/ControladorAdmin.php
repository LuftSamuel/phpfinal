<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorAdmin extends Controller
{
    public function index(){
        return view('admin');
    }
    
    public function crearMayor(){
        return view('crear_articulo_mayor');
    }
    
    public function crearMenor(){
        return view('crear_articulo_menor');
    }
    
    public function detalleProducto(){
        return view('detalle-producto');
    }
}