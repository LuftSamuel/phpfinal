<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planta;
use App\Models\Familia;
use App\Models\Mayor;
use App\Models\Menor;

class ControladorPrincipal extends Controller
{
    public function index(){
        $titulo = "Inicio";
        $plantas = Planta::all();
        $familias = Familia::all();
        $mayores = Mayor::all();
        $menores = Menor::all();
        return view('index',  compact('titulo', 'plantas', 'familias', 'mayores', 'menores'));
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