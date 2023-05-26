<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        //para verificar k funcion y k dejes la sesion activa, pero se paso abajo para k funcione correctamente
        // dd($request->remember);

        //en este caso cuando vamos a pasar los datos ya no es necesario
        // colocar las demas validacciones solo basta colocar que es requerido
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //vammos a autenticar si en login si las credenciales son correctas
        //eso va a rretornar un true o false asi que lo negamos primero
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'credenciales incorrectas');
            //back es atras asi k si esta mal el asuario regresara atras hacia adonde estaba
            //eeste mensaje aparece en login vista
        }
        //lo ultimo del user es xk en las rutas se solicita el user y contraseña y para este caso ya van autenticado
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
