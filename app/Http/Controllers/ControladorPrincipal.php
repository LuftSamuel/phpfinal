<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planta;
use App\Models\Familia;
use App\Models\Mayor;
use App\Models\Menor;

class ControladorPrincipal extends Controller
{
    
    public function busqueda(Request $request){
        //testo
        //$categoria = $request->categoria;
        //si uso request->input('categoria') obtengo de la url
        $categoria = $request->input('categoria');
        if($categoria == null){
            $categoria = 2;
        }
        /*
        if($categoria == 0){
            $categoria = 2;
        }else if($categoria == 1){
            $categoria = 0;
        }else if($categoria == 2){
            $categoria = 1;
        } */

        //testo
        
        //es la ruta la que llama al metodo buscar y el parametro lo saca
        //del input search, osea que la url no la estoy usando para nada
        $titulo = "Inicio";
        $parametro = $request->input('buscar');
        if(isset($categoria) && $categoria != 2){
            $plantas = Planta::where('nombre','like','%' . $parametro . '%')->
            where('tipo_venta' , $categoria)->
            orderBy('id_planta', 'desc')->
            paginate(8);
        }else{
            $plantas = Planta::where('nombre','like','%' . $parametro . '%')->
            orderBy('id_planta', 'desc')->
            paginate(8);
        }
        

        $familias = Familia::all();
        
        //testo
        $plantas->appends(['categoria' => $categoria]);
        //testo
        $plantas->appends(['buscar' => $parametro]); // para que la busqueda no se pierda al pasar de pagina
        //lo pue haber echo con el metodo withPath
        //podria usar withQueryString si tambien le paso la categoria

        

        
        
        return view('index',  compact('titulo', 'plantas', 'familias', 'parametro', 'categoria'));
    }
    
    public function detalleProducto($id){ //$id es el parametro que recibo de la ruta
        $titulo = "Detalle producto";
        $planta = Planta::find($id);
        $id_familia =  $planta->id_familia;
        if($planta->tipo_venta == 0){
            $datosExtra = Menor::find($id);
        }else{
            $datosExtra = Mayor::find($id); 
        }
        $familia = Familia::find($id_familia);
        //obtengo plantas con el mismo tipo de venta
        $relacionados = Planta::where('tipo_venta', $planta->tipo_venta)
        //excluyo la planta actual
        ->where('id_planta', '<>', $planta->id_planta)->paginate(8);

        return view('detalle-producto', compact('titulo','planta','relacionados','datosExtra','familia'));
    }
}