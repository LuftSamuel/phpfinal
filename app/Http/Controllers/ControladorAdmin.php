<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorAdmin extends Controller {

    public function index() {
        $titulo = "Administrador";
        return view('admin', ['titulo' => $titulo]);
    }

    public function crearMayor() {
        $titulo = "Articulo al por mayor";
        return view('crear_articulo_mayor', ['titulo' => $titulo]);
    }

    public function crearMenor() {
        $titulo = "Articulo al por menor";
        return view('crear_articulo_menor', ['titulo' => $titulo]);
    }

    public function detalleProducto() {
        //no me acuerdo por que esta aca esta vista, es una vista de usuario
        $titulo = "Detalle del producto";
        return view('detalle-producto', ['titulo' => $titulo]);
    }

}
