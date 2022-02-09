<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorPrincipal extends Controller
{
    public function index(){
        return view('index');
    }
    
    public function create(){
        //metodo encargado de mostrar un formulario para crear algo
    }
    
    public function show(){
        //metodo encargado de mostrar un elemento en particular (ej una sola planta)
    }
}