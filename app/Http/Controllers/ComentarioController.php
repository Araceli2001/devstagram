<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //validar
    public function store(Request $request, User $user, Post $post)
    {
        $this->validate($request, [
            'comentario' => 'required|max:200'
        ]);

         //almacenar el resultado el comentario
     comentario::create([
         'user_id' => auth()->user()->id,
         'post_id' => $post->id,
         'comentario' => $request->comentario
    ]);

    //Imprimir un mensaje dee respuesta
    return back()->with('mensaje', 'Comentario enviado correctamnte');




    
    }  
}
