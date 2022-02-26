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
        $plantas = Planta::where('nombre','like','%' . $parametro . '%')->paginate(4); //resultado
        $familias = Familia::all();
        $mayores = Mayor::all();
        $menores = Menor::all();
        
        $plantas->appends(['buscar' => $parametro]);
        
        return view('index',  compact('titulo', 'plantas', 'familias', 'mayores', 'menores', 'parametro'));
    }
    
    public function detalleProducto($id){ //$id es el parametro que recibo de la ruta
        //ese $producto que recibo es solo el nombre de la imagen sin extension
        $titulo = "Detalle producto";
        $planta = Planta::where('id_planta',$id)->get();
        //dd($planta);
        return view('detalle-producto', compact('titulo','planta'));
    }
}