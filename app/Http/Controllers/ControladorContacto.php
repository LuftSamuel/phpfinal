<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;
use Carbon\Carbon;

class ControladorContacto extends Controller {

    public function index() {
        $titulo = 'Contacto';
        return view('contacto', ['titulo' => $titulo]);
    }

    public function Contacto(Request $request) {
        $request->validate([
            'enviado' => Carbon::now(),
            'nombre' => 'required|max:100|alpha',
            'email' => 'required|email|max:100',
            'motivo' => 'required|string',
            'mensaje' => 'required|max:10000|string'
        ]);
        
        Contacto::create($request->all());
        
        return back()->with('success', 'We have received your message and would like'
                . ' to thank you for writing to us.'); //de nuevo no recibo el mensaje
    }

}
