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
        $plantas = Planta::paginate(); //recuperar solo algunos en vez de todos
        $familias = Familia::all();
        $mayores = Mayor::all();
        $menores = Menor::all();
        return view('index',  compact('titulo', 'plantas', 'familias', 'mayores', 'menores'));
    }
    
    public function busqueda(Request $request){
        $titulo = "Inicio";
        //$plantas = Planta::paginate(); //recuperar solo algunos en vez de todos
        $parametro = $request->buscar;
        //$parametro = $_GET['buscar'];
        $plantas = Planta::where('nombre','like','%' . $parametro . '%')->get(); //resultado
  
        $familias = Familia::all();
        $mayores = Mayor::all();
        $menores = Menor::all();
        return view('index',  compact('titulo', 'plantas', 'familias', 'mayores', 'menores'));
    }
    
    public function detalleProducto($id){ //$id es el parametro que recibo de la ruta
        //ese $producto que recibo es solo el nombre de la imagen sin extension
        $titulo = "Detalle producto";
        $planta = Planta::where('id_planta',$id)->get();
        //dd($planta);
        return view('detalle-producto', compact('titulo','planta'));
    }
}