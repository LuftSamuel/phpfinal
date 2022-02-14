<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Planta;
use App\Models\Familia;
use App\Models\Mayor;
use App\Models\Menor;

class ControladorAdmin extends Controller {

    public function index() {
        $titulo = "Administrador";
        return view('admin', ['titulo' => $titulo]);
    }

    public function formularioMayor() {
        $titulo = "Articulo al por mayor";
        return view('crear_articulo_mayor', ['titulo' => $titulo]);
    }
    
    public function crearMayor(Request $request) { //con el request recibo toda la info del formulario
        //dd($request);
        
        /*$planta = new Planta([ //Planta::create
            'nombre' => $request->input('nombre'),
            'tipo_venta' => 0,
            'id_familia' => 0, //crear ese input, con el dropdown button
            'direccion_imagen' => $request->input('archivo_imagen'),
            'titulo_imagen' => "imagen"            
        ]);*/
        
        $planta = new Planta();
        //el nombre de la planta, ej: aloe vera
        $planta->nombre = $request->nombre;
        //el tipo de venta, en este formulario siempre es 1 osea mayorista
        $planta->tipo_venta = 1;
        //id de la familia a la que pertenece la planta
        $planta->id_familia = 0; //crear ese input, con el dropdown button
        /////////////////////
        if($request->hasFile('archivo_imagen')){
            //archivo, el que se sube a la carpeta imagenes, no a la bd
            $archivo_imagen = $request->file('archivo_imagen');
            //titulo
            $titulo_imagen = Str::slug($request->nombre) . "." . $archivo_imagen->guessExtension();
            //direccion
            $ruta = public_path("imagenes/");
            //subo el archivo, creo
            $archivo_imagen->move($ruta,$titulo_imagen);
            
            //esto esta de sobra?
            //$planta->archivo_imagen = $titulo_imagen;
        }
        
        //le asigno el titulo:imagen que tenia arriba y use para subir a la carpeta imagenes
        $planta->titulo_imagen = $titulo_imagen;
        //guardo la ruta que tenia en la variable $ruta
        $planta->direccion_imagen = $ruta;
        //$planta->direccion_imagen = $request->archivo_imagen;
         
        $planta->save();
        
        $titulo = "Index";
        //return redirect('index', ['titulo' => $titulo]); <- por algun motivo misterioso da error
        return redirect('index');
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
