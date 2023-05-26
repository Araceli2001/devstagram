<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store()
    {
        //Para cerrar sesion y que nos redireccione (mandar a la vista login)
        auth()->logout();
        return redirect()->route('login');
    }
}
