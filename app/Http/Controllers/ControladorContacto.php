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
        $this->validate($request, [
            'enviado' => Carbon::now(),
            'nombre' => 'required',
            'email' => 'required|email',
            'motivo' => 'required',
            'mensaje' => 'required'
        ]);
        Contacto::create($request->all());
        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }

}
