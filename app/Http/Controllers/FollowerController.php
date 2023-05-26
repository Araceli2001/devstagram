<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //el user k ponemos es del k vamos a seguir ok
    //y ese request es para enviar la peticion de k vamos a seguir ese usuario
    public function store(User $user)
    {
        //attach es cuando relacionas datos de la misma tabla x ejemplo user_id con flower_id
        $user->followers()->attach( auth()->user()->id );

        return back();
    }

    public function destroy(User $user)
    {
        //attach es PARA  el boton de ELIMINAR publicacion
        $user->followers()->detach( auth()->user()->id );

        return back();
    }
}
