<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //se llama el metoddo asi xk cuando lleva solo un metodo el controlador
    //es recomedable llamarlo asi y en la ruta no se pone
    public function __invoke()
    {
        //Obtener a quienes seguimos
        /*
        latest: es para k el ultimo post k hizo el usuario nos aparesca primero 
        */
        $ids = ( auth()->user()->followings->pluck('id')->toArray() );
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
