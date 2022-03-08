<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Planta;
use App\Models\Familia;
use App\Models\Mayor;
use App\Models\Menor;
use Illuminate\Validation\ValidationException;
use App\Models\Contacto;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class ControladorAdmin extends Controller {

    public function index() {
        $titulo = "Panel admin";

        //$mensajes = Contacto::paginate()->latest;
        $mensajes = Contacto::orderBy('id', 'DESC')->limit(16)->get();

        return view('admin', compact('titulo', 'mensajes'));
    }

    public function formularioMayor(Request $request) {
        $titulo = "Articulo al por mayor";
        $familias = Familia::all();
        $mayores = Mayor::all();
        $menores = Menor::all();

        if($request->filled('id')){
            $modificar_planta = Planta::find($request->id);
            $modificar_mayor = Mayor::where('id_planta', $request->id)->first();
            return view('admin', compact('titulo', 'modificar_planta', 'familias', 'modificar_mayor'));
        }else{
            $plantas = planta::all();
        }       
        return view('admin', compact('titulo', 'plantas', 'familias', 'mayores', 'menores'));
    }

    public function crearMayor(Request $request) { //con el request recibo toda la info del formulario
        $request->validate([
            'nombre' => 'bail|required|max:100',
            'archivo_imagen' => 'bail|required|image|mimes:jpg,png,jpeg,svg,webp|max:4096|dimensions:min_width=800,min_height=600',
            'pedido_minimo' => 'bail|required|numeric|integer',
        ]);
        $planta = new Planta();
        $planta->nombre = $request->nombre;
        $planta->tipo_venta = 1;
        $planta->id_familia = $request->familia;

        $siguiente_id = DB::table('information_schema.TABLES')
            ->select('AUTO_INCREMENT')
            ->where('TABLE_NAME', "planta")
            ->get();
        $s = $siguiente_id[1]; //el numero esta ahi dentro pero no se como sacarlo
        $s = $s->AUTO_INCREMENT;    
        $id = preg_replace('/\D/', '', $s);

        $path = public_path('imagenes/' . $id);
        if (!File::isDirectory($path)) {
            $r = File::makeDirectory($path, 0777, true, true);
        }
        //fin test 28/02

        
        ///////////////////////test27/02
        //$temp = Planta::orderBy('id_planta', 'DESC')->first();
        //$id = $temp->id_planta + 1;
        if ($request->hasFile('archivo_imagen')) {
            //test27/02
            /* $path = public_path('imagenes/' . $id);
              if (!File::isDirectory($path)) {
              $response = File::makeDirectory($path, 0777, true, true);

              } */

            //titulo original 01/03
            $titulo_imagen = $request->archivo_imagen->getClientOriginalName();
            $planta->titulo_imagen = $titulo_imagen;
            //archivo, el que se sube a la carpeta imagenes, no a la bd
            $archivo_imagen = $request->file('archivo_imagen');
            //titulo, quitar espacios
            //$titulo_imagen = Str::slug($request->nombre) . "." . $archivo_imagen->guessExtension();
            //direccion
            //$ruta = public_path("imagenes/");
            $ruta = $path;
            //subo el archivo
            $archivo_imagen->move($ruta, $titulo_imagen);
            //miniatura, (intervention image)
            $miniatura = Image::make($ruta . '/' . $titulo_imagen)->resize(300, 200); //jugar un poco con las dimensiones
            $miniatura->save($ruta . '/' . 'm' . $titulo_imagen, 60);
        }
        //le asigno el titulo_imagen que tenia arriba y use para subir a la carpeta imagenes
        $planta->titulo_imagen = $titulo_imagen;
        //guardo la ruta que tenia en la variable $ruta
        $planta->direccion_imagen = $ruta;

        $planta->save();

        $mayor = new Mayor();
        $mayor->id_planta = $planta->id_planta;
        $mayor->pedido_minimo = $request->pedido_minimo;

        $mayor->save();

        return redirect('index');
    }

    public function formularioMenor(Request $request) {
        $titulo = "Articulo al por menor";        
        $familias = Familia::all();
        $mayores = Mayor::all();
        $menores = Menor::all();

        if($request->filled('id')){
            $modificar_planta = Planta::find($request->id);
            $modificar_menor = Menor::where('id_planta', $request->id)->first();
            return view('admin', compact('titulo', 'modificar_planta', 'familias', 'modificar_menor'));
        }else{
            $plantas = planta::all();
        }
        return view('admin', compact('titulo', 'plantas', 'familias', 'mayores', 'menores'));
    }

    public function crearMenor(Request $request) {
        $request->validate([
            'nombre' => 'bail|required|max:100',
            'archivo_imagen' => 'bail|required|image|mimes:jpg,png,jpeg,svg,webp|max:4096|dimensions:min_width=800,min_height=600',
            'cantidad_stock' => 'bail|required|numeric|integer',
            'precio_unitario' => 'bail|required|numeric|integer',
        ]);
        $planta = new Planta();
        $planta->nombre = $request->nombre;
        $planta->tipo_venta = 0;
        $planta->id_familia = $request->familia;

        /*
        SELECT AUTO_INCREMENT
        FROM information_schema.TABLES
        WHERE TABLE_SCHEMA = "yourDatabaseName"
        AND TABLE_NAME = "yourTableName"
        */

        $siguiente_id = DB::table('information_schema.TABLES')
            ->select('AUTO_INCREMENT')
            ->where('TABLE_NAME', "planta")
            ->get();
        $s = $siguiente_id[1];
        $s = $s->AUTO_INCREMENT;    
        $id = preg_replace('/\D/', '', $s);

        //obtengo la id de la planta que estoy por cargar
        /*$temp = Planta::orderBy('id_planta', 'DESC')->first();
        if ($temp != null) { ///////////////esto da problemas 
            $id = $temp->id_planta + 1;
        } else {
            //esto no funciona
            $id = 1;
        }*/
        //la uso para crear una carpeta con el nombre de esa id
        $path = public_path('imagenes/' . $id);
        if (!File::isDirectory($path)) {
            $r = File::makeDirectory($path, 0777, true, true);
        }
        ////

        
        if ($request->hasFile('archivo_imagen')) {
            //titulo original 01/03
            $titulo_imagen = $request->archivo_imagen->getClientOriginalName();
            $planta->titulo_imagen = $titulo_imagen;
            //archivo, el que se sube a la carpeta imagenes, no a la bd
            $archivo_imagen = $request->file('archivo_imagen');
            //titulo
            //$titulo_imagen = Str::slug($request->nombre) . "." . $archivo_imagen->guessExtension();
            //direccion
            //$ruta = public_path("imagenes/");
            $ruta = $path;
            //subo el archivo
            $archivo_imagen->move($ruta, $titulo_imagen);
            //miniatura, (intervention image)
            $miniatura = Image::make($ruta . '/' . $titulo_imagen)->resize(300, 200); //jugar un poco con las dimensiones
            $miniatura->save($ruta . '/' . 'm' . $titulo_imagen, 60);
            
       
        }
        //le asigno el titulo:imagen que tenia arriba y use para subir a la carpeta imagenes
        $planta->titulo_imagen = $titulo_imagen;
        //guardo la ruta que tenia en la variable $ruta
        $planta->direccion_imagen = $ruta;

        $planta->save();

        $menor = new Menor();
        $menor->id_planta = $planta->id_planta;
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

    public function formularioFamilia() {
        $titulo = "Familias";

        $familias = Familia::all();
        $plantas = Planta::all();

        return view('admin', compact('titulo', 'familias', 'plantas'));
    }

    public function crearFamilia(Request $request) {
        $request->validate([
            'familia' => 'bail|required|max:100',
        ]);
        $familia = new Familia();
        $familia->familia = $request->familia;
        $familia->save();

        return redirect('index');
    }

    public function borrarFamilia(Request $request) {
        $id_familia = $request->id_familia;
        //$familia = Familia::find($id_familia);
        $familia = Familia::where('id_familia', $id_familia);
        $familia->delete();

        return redirect('index');
    }

    public function modificarFamilia(Request $request) {
        $id_familia = $request->id_familia;
        $familia = Familia::where('id_familia', $id_familia)->first();
        $familia->familia = $request->nombre;
        $familia->save();

        return redirect('index');
    }

    public function formularioPlanta() {
        $titulo = "Plantas";

        $familias = Familia::all();
        $plantas = Planta::all();

        return view('admin', compact('titulo', 'familias', 'plantas'));
    }
    
    public function modificarMenor(Request $request) {
        //me falta eliminar la imagen e insertar la nueva o reemplazar
        
        $titulo = "Articulo al por menor";
        $request->validate([
            'nombre' => 'bail|required|max:100',
            'archivo_imagen' => 'bail|required|image|mimes:jpg,png,jpeg,svg,webp|max:4096|dimensions:min_width=800,min_height=600',
            'cantidad_stock' => 'bail|required|numeric|integer',
            'precio_unitario' => 'bail|required|numeric|integer',
        ]);
        //obtengo la id de la planta que estoy por modificar
        $id = $request->id;
        $planta = Planta::find($id);
        //la uso para crear una carpeta con el nombre de esa id
        $path = public_path('imagenes/' . $id);
        if (!File::isDirectory($path)) {
            $r = File::makeDirectory($path, 0777, true, true);
        }
        $planta->nombre = $request->nombre;
        $planta->tipo_venta = 0;
        $planta->id_familia = $request->familia;
        if ($request->hasFile('archivo_imagen')) {
            
            File::delete($path . '/' . $planta->titulo_imagen);
            File::delete($path . '/' . 'm' . $planta->titulo_imagen);

            //titulo original 01/03
            $titulo_imagen = $request->archivo_imagen->getClientOriginalName();
            $planta->titulo_imagen = $titulo_imagen;
            //archivo, el que se sube a la carpeta imagenes, no a la bd
            $archivo_imagen = $request->file('archivo_imagen');
            //titulo
            //$titulo_imagen = Str::slug($request->nombre) . "." . $archivo_imagen->guessExtension();
            //direccion
            //$ruta = public_path("imagenes/");
            $ruta = $path;
            //subo el archivo
            $archivo_imagen->move($ruta, $titulo_imagen);
            //miniatura, (intervention image)
            $miniatura = Image::make($ruta . '/' . $titulo_imagen)->resize(300, 200); //jugar un poco con las dimensiones
            $miniatura->save($ruta . '/' . 'm' . $titulo_imagen, 60);
            
       
        }
        //le asigno el titulo:imagen que tenia arriba y use para subir a la carpeta imagenes
        $planta->titulo_imagen = $titulo_imagen;
        //guardo la ruta que tenia en la variable $ruta
        $planta->direccion_imagen = $ruta;

        $planta->save();

        $menor = Menor::where('id_planta', $id)->first();
        $menor->cantidad_stock = $request->cantidad_stock;
        $menor->precio_unitario = $request->precio_unitario;

        $menor->save();

        //$titulo = "Articulo al por menor";
        //return view('crear_articulo_menor', ['titulo' => $titulo]);
        return redirect('index');
    }
    
    public function modificarMayor(Request $request){
        $request->validate([
            'nombre' => 'bail|required|max:100',
            'archivo_imagen' => 'bail|required|image|mimes:jpg,png,jpeg,svg,webp|max:4096|dimensions:min_width=800,min_height=600',
            'pedido_minimo' => 'bail|required|numeric|integer',
        ]);
        //obtengo la id de la planta que estoy por modificar
        $id = $request->id;
        $planta = Planta::find($id);
        //la uso para crear una carpeta con el nombre de esa id
        $path = public_path('imagenes/' . $id);
        if (!File::isDirectory($path)) {
            $r = File::makeDirectory($path, 0777, true, true);
        }
        $planta->nombre = $request->nombre;
        $planta->tipo_venta = 1;
        $planta->id_familia = $request->familia;
        if ($request->hasFile('archivo_imagen')) {
            
            File::delete($path . '/' . $planta->titulo_imagen);
            File::delete($path . '/' . 'm' . $planta->titulo_imagen);

            //titulo original 01/03
            $titulo_imagen = $request->archivo_imagen->getClientOriginalName();
            $planta->titulo_imagen = $titulo_imagen;
            //archivo, el que se sube a la carpeta imagenes, no a la bd
            $archivo_imagen = $request->file('archivo_imagen');
            //titulo
            //$titulo_imagen = Str::slug($request->nombre) . "." . $archivo_imagen->guessExtension();
            //direccion
            //$ruta = public_path("imagenes/");
            $ruta = $path;
            //subo el archivo
            $archivo_imagen->move($ruta, $titulo_imagen);
            //miniatura, (intervention image)
            $miniatura = Image::make($ruta . '/' . $titulo_imagen)->resize(300, 200); //jugar un poco con las dimensiones
            $miniatura->save($ruta . '/' . 'm' . $titulo_imagen, 60);
            
       
        }
        //le asigno el titulo_imagen que tenia arriba y use para subir a la carpeta imagenes
        $planta->titulo_imagen = $titulo_imagen;
        //guardo la ruta que tenia en la variable $ruta
        $planta->direccion_imagen = $ruta;

        $planta->save();

        $mayor = Mayor::where('id_planta', $id)->first();
        $mayor->pedido_minimo = $request->pedido_minimo;

        $mayor->save();

        return redirect('index');
    }

    public function eliminarPlanta(Request $request){
        $id = $request->id;
        $planta = Planta::find($id);
        $path = public_path('imagenes/' . $id);
        File::delete($path . '/' . $planta->titulo_imagen);
        File::delete($path . '/' . 'm' . $planta->titulo_imagen);        
        if (File::exists($path)) File::deleteDirectory($path);      

        if($planta->tipo_venta == 0){
            $menor = Menor::where('id_planta', $id)->first()->delete();
        }else{
            $mayor = Mayor::where('id_planta', $id)->first()->delete();
        }       

        $planta = Planta::find($id)->delete();
        
        return redirect('index');
    }

}
