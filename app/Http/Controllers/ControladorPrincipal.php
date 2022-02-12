<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorPrincipal extends Controller
{
    public function index(){
        $titulo = "Inicio";
        return view('index', ['titulo' => $titulo]);
    }
    
    public function detalleProducto($producto){
        $titulo = "Detalle producto";
        return view('detalle-producto', ['titulo' => $titulo, 'producto' => $producto]);
    }
    
    public function create(){
        //metodo encargado de mostrar un formulario para crear algo
    }
    
    public function show(){
        //metodo encargado de mostrar un elemento en particular (ej una sola planta)
    }
}