<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ControladorLogin extends Controller
{
    public function login() {
        $titulo = "Login";
        return view('admin_login', compact('titulo'));
    }    

    public function autenticarse(Request $request) {
        $credenciales = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string']
        ]);
        $recordar = $request->filled('recordar');
        if (Auth::attempt($credenciales, $recordar)) {
            //regenerar la sesion para evitar session fixation
            request()->session()->regenerate();
            return redirect(route('admin.index'));
        }
        throw ValidationException::withMessages([
            'email' => 'Credenciales incorrectas.'
        ]); //no hace nada esto
    }
    
    public function desloguearse(Request $request) {
        //eliminar informacion de autenticacion de la sesion
        Auth::logout();
        //invalidar sesion y generar una nueva
        $request->session()->invalidate();
        //regenerar tokern csrf
        $request->session()->regenerateToken();
        return redirect(route('inicio'))->with('status','has cerrado cesion.'); //no se muestra el mensaje, capaz por los estilos           
    }
    
}
