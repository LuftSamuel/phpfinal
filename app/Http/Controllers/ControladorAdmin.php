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

class ControladorAdmin extends Controller
{

    public function index()
    { //la pagina principal del admin es donde ve los mensajes
        $titulo = "Panel admin";

        $mensajes = Contacto::orderBy('id', 'desc')->paginate(12);
        //$mensajes = Contacto::orderBy('id', 'DESC')->limit(16)->get();

        return view('admin', compact('titulo', 'mensajes'));
    }

    public function eliminarMensaje(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $id_mensaje = $request->id;
        $mensaje = Contacto::find($id_mensaje);
        $mensaje->delete();

        $request->session()->flash('alert-success', 'Mensaje Eliminado!');
        return back();
    }

    public function formularioMayor(Request $request)
    {
        $titulo = "Articulo al por mayor";
        $familias = Familia::all();
        //$mayores = Mayor::all();
        //$menores = Menor::all();

        if ($request->filled('id')) {
            $modificar_planta = Planta::find($request->id);
            $modificar_mayor = Mayor::where('id_planta', $request->id)->first();
            return view('admin', compact('titulo', 'modificar_planta', 'familias', 'modificar_mayor'));
        } else {
            return view('admin', compact('titulo', 'familias'));
        }
    }

    public function crearMayor(Request $request)
    {
        $request->validate([
            'nombre' => 'bail|required|max:100',
            'archivo_imagen' => 'bail|required|image|mimes:jpg,png,jpeg,svg,webp|max:4096|dimensions:min_width=800,min_height=600',
            'pedido_minimo' => 'bail|required|numeric|integer',
        ]);
        $planta = new Planta();
        $planta->nombre = $request->nombre;
        $planta->tipo_venta = 1;
        $planta->id_familia = $request->familia;

        /*
        SELECT AUTO_INCREMENT
        FROM information_schema.TABLES
        WHERE TABLE_SCHEMA = "yourDatabaseName"
        AND TABLE_NAME = "yourTableName"
        */

        //obtengo la id de la planta que estoy por cargar
        $siguiente_id = DB::table('information_schema.TABLES')
            ->select('AUTO_INCREMENT')
            ->where('TABLE_NAME', "planta")
            ->get();
        $s = $siguiente_id[1];
        $s = $s->AUTO_INCREMENT;
        $id = preg_replace('/\D/', '', $s); //seguro hay alguna forma mas sencilla de obtener ese numero

        //la uso para crear una carpeta con el nombre de esa id
        $path = public_path('imagenes/' . $id);
        if (!File::isDirectory($path)) {
            $r = File::makeDirectory($path, 0777, true, true);
        }

        if ($request->hasFile('archivo_imagen')) {
            //titulo original
            $titulo_imagen = $request->archivo_imagen->getClientOriginalName();
            $planta->titulo_imagen = $titulo_imagen;
            //archivo, el que se sube a la carpeta imagenes, no a la bd
            $archivo_imagen = $request->file('archivo_imagen');
            //$ruta
            $ruta = $path; //usar una sola variable
            //subo el archivo
            $archivo_imagen->move($ruta, $titulo_imagen);
            //miniatura, (libreria: intervention image)
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

        $request->session()->flash('alert-success', 'Producto Agregado!.');
        return back();
    }

    public function formularioMenor(Request $request)
    {
        $titulo = "Articulo al por menor";
        $familias = Familia::all();
        $mayores = Mayor::all();
        $menores = Menor::all();

        if ($request->filled('id')) {
            $modificar_planta = Planta::find($request->id);
            $modificar_menor = Menor::where('id_planta', $request->id)->first();
            return view('admin', compact('titulo', 'modificar_planta', 'familias', 'modificar_menor'));
        } else {
            $plantas = planta::all();
        }
        return view('admin', compact('titulo', 'plantas', 'familias', 'mayores', 'menores'));
    }

    public function crearMenor(Request $request)
    {
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

        //obtengo la id de la planta que estoy por cargar
        $siguiente_id = DB::table('information_schema.TABLES')
            ->select('AUTO_INCREMENT')
            ->where('TABLE_NAME', "planta")
            ->get();
        $s = $siguiente_id[1];
        $s = $s->AUTO_INCREMENT;
        $id = preg_replace('/\D/', '', $s);

        //la uso para crear una carpeta con el nombre de esa id
        $path = public_path('imagenes/' . $id);
        if (!File::isDirectory($path)) {
            $r = File::makeDirectory($path, 0777, true, true);
        }

        if ($request->hasFile('archivo_imagen')) {
            //titulo original
            $titulo_imagen = $request->archivo_imagen->getClientOriginalName();
            $planta->titulo_imagen = $titulo_imagen;
            //archivo, el que se sube a la carpeta imagenes, no a la bd
            $archivo_imagen = $request->file('archivo_imagen');
            //$ruta = public_path("imagenes/");
            $ruta = $path;
            //subo el archivo
            $archivo_imagen->move($ruta, $titulo_imagen);
            //miniatura, (libreria: intervention image)
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

        $request->session()->flash('alert-success', 'Producto Agregado!.');
        return back();
    }

    public function formularioFamilia()
    {
        $titulo = "Familias";

        $familias = Familia::all();
        $plantas = Planta::all(); //lo uso para evitar eliminar familias que esten asignadas a una planta

        return view('admin', compact('titulo', 'familias', 'plantas'));
    }

    public function crearFamilia(Request $request)
    {
        $request->validate([
            'familia' => 'bail|required|max:100',
        ]);
        $familia = new Familia();
        $familia->familia = $request->familia;
        $familia->save();

        $request->session()->flash('fm_crear', 'Familia Agregada!');
        return back();
    }

    public function borrarFamilia(Request $request)
    {
        $request->validate([
            'id_familia' => 'required',
        ]);
        $id_familia = $request->id_familia;
        $familia = Familia::find($id_familia);
        $familia->delete();

        $request->session()->flash('fm_eliminar', 'Familia Eliminada!');
        return back();
    }

    public function modificarFamilia(Request $request)
    {
        $request->validate([
            'nombre' => 'bail|required|max:100',
        ]);
        $id_familia = $request->id_familia;
        $familia = Familia::find($id_familia);
        $familia->familia = $request->nombre;
        $familia->save();

        $request->session()->flash('fm_modificar', 'Familia Modificada!');
        return back();
    }

    public function formularioPlanta()
    { //formulario de administrar plantas
        $titulo = "Plantas";

        $familias = Familia::all();
        $plantas = Planta::orderBy('id_planta', 'desc')->paginate(12);

        return view('admin', compact('titulo', 'familias', 'plantas'));
    }

    public function modificarMenor(Request $request)
    {
        $titulo = "Articulo al por menor";
        $request->validate([
            'nombre' => 'bail|required|max:100',
            'archivo_imagen' => 'bail|image|mimes:jpg,png,jpeg,svg,webp|max:4096|dimensions:min_width=800,min_height=600',
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
            //borro la imagen y la miniatura (la carpeta sigue existiendo)
            File::delete($path . '/' . $planta->titulo_imagen);
            File::delete($path . '/' . 'm' . $planta->titulo_imagen);
            //titulo original
            $titulo_imagen = $request->archivo_imagen->getClientOriginalName();
            $planta->titulo_imagen = $titulo_imagen;
            //archivo, el que se sube a la carpeta imagenes, no a la bd
            $archivo_imagen = $request->file('archivo_imagen');
            //$ruta = public_path("imagenes/");
            $ruta = $path;
            //subo el archivo
            $archivo_imagen->move($ruta, $titulo_imagen);
            //miniatura, (libreria: intervention image)
            $miniatura = Image::make($ruta . '/' . $titulo_imagen)->resize(300, 200); //jugar un poco con las dimensiones
            $miniatura->save($ruta . '/' . 'm' . $titulo_imagen, 60);
            //le asigno el titulo:imagen que tenia arriba y use para subir a la carpeta imagenes
            $planta->titulo_imagen = $titulo_imagen;
            //guardo la ruta que tenia en la variable $ruta
            $planta->direccion_imagen = $ruta;
        }


        $planta->save();

        $menor = Menor::find($id);
        $menor->cantidad_stock = $request->cantidad_stock;
        $menor->precio_unitario = $request->precio_unitario;

        $menor->save();

        $request->session()->flash('alert-success', 'Producto Modificado!.');
        return back();
    }

    public function modificarMayor(Request $request)
    {
        $request->validate([
            'nombre' => 'bail|required|max:100',
            'archivo_imagen' => 'bail|image|mimes:jpg,png,jpeg,svg,webp|max:4096|dimensions:min_width=800,min_height=600',
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
            //borro la imagen y la miniatura (la carpeta sigue existiendo)
            File::delete($path . '/' . $planta->titulo_imagen);
            File::delete($path . '/' . 'm' . $planta->titulo_imagen);
            //titulo original
            $titulo_imagen = $request->archivo_imagen->getClientOriginalName();
            $planta->titulo_imagen = $titulo_imagen;
            //archivo, el que se sube a la carpeta imagenes, no a la bd
            $archivo_imagen = $request->file('archivo_imagen');
            //$ruta = public_path("imagenes/");
            $ruta = $path;
            //subo el archivo
            $archivo_imagen->move($ruta, $titulo_imagen);
            //miniatura, (intervention image)
            $miniatura = Image::make($ruta . '/' . $titulo_imagen)->resize(300, 200); //jugar un poco con las dimensiones
            $miniatura->save($ruta . '/' . 'm' . $titulo_imagen, 60);
            //le asigno el titulo_imagen que tenia arriba y use para subir a la carpeta imagenes
            $planta->titulo_imagen = $titulo_imagen;
            //guardo la ruta que tenia en la variable $ruta
            $planta->direccion_imagen = $ruta;
        }


        $planta->save();

        $mayor = Mayor::find($id);
        $mayor->pedido_minimo = $request->pedido_minimo;

        $mayor->save();

        $request->session()->flash('alert-success', 'Producto Modificado!.');
        return back();
    }

    public function eliminarPlanta(Request $request)
    {
        $id = $request->id;
        $planta = Planta::find($id);
        $path = public_path('imagenes/' . $id);
        //borro ambas imagenes
        File::delete($path . '/' . $planta->titulo_imagen);
        File::delete($path . '/' . 'm' . $planta->titulo_imagen);
        //borro la carpeta
        if (File::exists($path)) File::deleteDirectory($path);

        //borro el registro que le corresponda en la tabla mayor o menor
        if ($planta->tipo_venta == 0) {
            $menor = Menor::where('id_planta', $id)->first()->delete();
        } else {
            $mayor = Mayor::where('id_planta', $id)->first()->delete();
        }

        $planta = Planta::find($id)->delete();

        $request->session()->flash('alert-success', 'Producto Eliminado!.');
        return back();
    }
}
