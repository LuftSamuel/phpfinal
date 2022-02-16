<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Planta;
use App\Models\Familia;
use App\Models\Mayor;
use App\Models\Menor;

class ControladorAdmin extends Controller {

    public function login(){
        $titulo = "Login";
        return view('admin_login', compact('titulo'));
    }
    
    public function index(){
        $titulo = "Panel admin";
        return view('admin', compact('titulo'));
    }
    
    public function formularioMayor() {
        $titulo = "Articulo al por mayor";
        $plantas = planta::all();
        $familias = Familia::all();
        $mayores = Mayor::all();
        $menores = Menor::all();
        return view('admin', compact('titulo', 'plantas', 'familias', 'mayores', 'menores'));
    }

    public function crearMayor(Request $request) { //con el request recibo toda la info del formulario
        //me falta el dato del pedido minimo que se guardara en la tabla mayor
        
        $planta = new Planta();
        //el nombre de la planta, ej: aloe vera
        $planta->nombre = $request->nombre;
        //el tipo de venta, en este formulario siempre es 1 osea mayorista
        $planta->tipo_venta = 1;
        //id de la familia a la que pertenece la planta
        $planta->id_familia = $request->familia;
        /////////////////////
        if ($request->hasFile('archivo_imagen')) {
            //archivo, el que se sube a la carpeta imagenes, no a la bd
            $archivo_imagen = $request->file('archivo_imagen');
            //titulo
            $titulo_imagen = Str::slug($request->nombre) . "." . $archivo_imagen->guessExtension();
            //direccion
            $ruta = public_path("imagenes/");
            //subo el archivo
            $archivo_imagen->move($ruta, $titulo_imagen);
        }

        //le asigno el titulo:imagen que tenia arriba y use para subir a la carpeta imagenes
        $planta->titulo_imagen = $titulo_imagen;
        //guardo la ruta que tenia en la variable $ruta
        $planta->direccion_imagen = $ruta;

        $planta->save();
        
        $mayor = new Mayor();
        $mayor->id_planta = $planta->id;
        $mayor->pedido_minimo = $request->pedido_minimo;
        
        $mayor->save();

        //$titulo = "Index";
        //return redirect('index', ['titulo' => $titulo]); <- por algun motivo misterioso da error
        return redirect('index');
    }
    
    public function formularioMenor() {
        $titulo = "Articulo al por menor";
        $plantas = planta::all();
        $familias = Familia::all();
        $mayores = Mayor::all();
        $menores = Menor::all();
        return view('admin', compact('titulo', 'plantas', 'familias', 'mayores', 'menores'));
    }

    public function crearMenor(Request $request) {
        //me faltan 2 datos: cantidad en stock y precio unitario que se van a guardar en la tabla menor
        
        $planta = new Planta();
        //el nombre de la planta, ej: aloe vera
        $planta->nombre = $request->nombre;
        //el tipo de venta, en este formulario siempre es 0 osea minorista
        $planta->tipo_venta = 0;
        //id de la familia a la que pertenece la planta
        $planta->id_familia = $request->familia;
        /////////////////////
        if ($request->hasFile('archivo_imagen')) {
            //archivo, el que se sube a la carpeta imagenes, no a la bd
            $archivo_imagen = $request->file('archivo_imagen');
            //titulo
            $titulo_imagen = Str::slug($request->nombre) . "." . $archivo_imagen->guessExtension();
            //direccion
            $ruta = public_path("imagenes/");
            //subo el archivo
            $archivo_imagen->move($ruta, $titulo_imagen);
        }

        //le asigno el titulo:imagen que tenia arriba y use para subir a la carpeta imagenes
        $planta->titulo_imagen = $titulo_imagen;
        //guardo la ruta que tenia en la variable $ruta
        $planta->direccion_imagen = $ruta;

        $planta->save();
        
        $menor = new Menor();
        $menor->id_planta = $planta->id;
        $menor->cantidad_stock = $request->cantidad_stock;
        $menor->precio_unitario = $request->precio_unitario;

        $menor->save();

        //$titulo = "Articulo al por menor";
        //return view('crear_articulo_menor', ['titulo' => $titulo]);
        return redirect('index');
    }

    public function detalleProducto() {
        //no me acuerdo por que esta aca esta vista, es una vista de usuario
        $titulo = "Detalle del producto";
        return view('detalle-producto', ['titulo' => $titulo]);
    }

}
