<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        //con el middlleware va a mostrar k este autenticado
        //le pasamos esos metodos para que se pueda mostrar aunque no este autenticado
        //autenticado  pero solo para ver no podra ver me gusta etc.
        $this->middleware('auth')->except(['show', 'index']);
    }

    //es el user del modelo y el modelo para el user de la BD
    public function index(User $user)
    {

        $posts = Post::where('user_id', $user->id)->latest()->paginate(8);
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    //para que el usuario pueda  subir sus fotos
    public function create()
    {
        // dd('creando post...');
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        //------1
        //la infor k tengas aqui debe estar en el model Post
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        //-----2-----OTRA FORMA k es llo mismo de arriba--------
        //creas una variable y lle pones el modelo

        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();


        //3----ESTA ES UNA FORMA MAS CORRECTA 
        //a va detectar el user k est logueado
        //va a tomar la relacion k es el posts k creamos en el modelo y con el create CREAMOS el registro
        //k estara en la relacion y k llevvara los sig datos
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id'=> auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    //para las publiciones y commo para verlas necesito el user y el post k igual puse en las rutas
    //user y post en verde son los modelos
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        //Eliminar lla imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        
        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);  
           
    }
}
