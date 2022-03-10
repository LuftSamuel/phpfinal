<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planta;
use App\Models\Familia;
use App\Models\Mayor;
use App\Models\Menor;

class ControladorPrincipal extends Controller
{
    /*
    public function index(){
        $titulo = "Inicio";
        $plantas = Planta::paginate(4); //recuperar solo algunos en vez de todos
        $familias = Familia::all();
        $mayores = Mayor::all();
        $menores = Menor::all();
        return view('index',  compact('titulo', 'plantas', 'familias', 'mayores', 'menores'));
    }
     NO LO NECESITO, DEJO UN TIEMP=O POR SI LAS MOSCAS
     */
    
    public function busqueda(Request $request){
        $titulo = "Inicio";
        $parametro = $request->buscar;
        $plantas = Planta::where('nombre','like','%' . $parametro . '%')->paginate(16);
        $familias = Familia::all();
        $mayores = Mayor::all();
        $menores = Menor::all();
        
        $plantas->appends(['buscar' => $parametro]);
        
        return view('index',  compact('titulo', 'plantas', 'familias', 'mayores', 'menores', 'parametro'));
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