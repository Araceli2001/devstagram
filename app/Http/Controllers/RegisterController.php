<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
//Facades son funcion de Laravel para realizar ciertas acciones
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    //tipo Request y la variable se llama request
    public function store(Request $request)
    {
        // dd($request);
        // para ver un dato en especifico
        // dd($request->get('name'));

        //modificar request para username igual se modifica en la migracion de username
        //si el username ya existe k mande un mensaje y con esto evitamos k nos salga en forma de error
        $request->request->add(['username' => Str::slug($request->username) ]);

        //VALIDACION
        $this->validate($request, [
            'name' => 'required|max:15',
            'username' => 'required|unique:users|min:4|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:8'
        ]);

        //para la base de datos
        User::create([
            'name' => $request->name,
            //para los espcios y que sea unico el username y con slug lo valida 
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password) 
        ]);

        //Autenticar un usuario (attempt)quiere decir (intenta autenticar)
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        //otra forma de autenticar  (only=solo autentica a los campos tal)
        auth()->attempt($request->only('email', 'password'));

        //Redireccionar lo de register hacia esta vista
        return redirect()->route('posts.index', auth()->user() );
    }
}
