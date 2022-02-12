<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorContacto extends Controller
{
    public function index(){
        $titulo = 'Contacto';
        return view('contacto', ['titulo' => $titulo]);
    }
    
    public function create(){
        //metodo encargado de mostrar un formulario para crear algo
    }
    
    public function show(){
        //metodo encargado de mostrar un elemento en particular (ej una sola planta)
    }
}