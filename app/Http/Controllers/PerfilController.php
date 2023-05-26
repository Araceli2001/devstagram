<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //para proteger la ruta con middleware
    public function __construct()
    {
        $this->middleware('auth');
    }

    //para k el usuario suba su imagen
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request) 
    {
        //para que no se repita el username
        $request->request->add(['username' => Str::slug($request->username) ]);
        //para el email
        // $request->request->add(['email' => Str::slug($request->email) ]);
        
        //para que valide el username k vas a cambiar, el  NOT_IN es para que el usuario no ponga esos nombres
        //al igual tambien existe (in) para k el usuario solo eliga esos nombre k colocas (142video)
        //auth()->user->id k puse es para k valide el username 
        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' .auth()->user()->id, 'max:20', 'not_in:twitter,facebook',],
        ]);
        //para el email
        // $this->validate($request, [
        //     'email' => ['required', 'unique:users,email,' .auth()->user()->id, 'max:40',],
        // ]);

        //buscamos al usuario x su id
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;


        //el usuario si sube una foto y cambia igual su username
        if($request->imagen) {
            $imagen1 = $request->file('imagen');
            //para que las img k suban teengan un unico id
            $nombreImagen = Str::uuid() . "." . $imagen1->extension();
            //es para guardarla x lo mientras solo lo guarda en memoria
            $imagenServidor = Image::make($imagen1);
            //fit es cuadrado y cuanto va a medir
            $imagenServidor->fit(1000, 1000);
            //en este apartado se guardaran las imagenes en la carpeta uploads
            //la "/" es para que se vea algo asi uploads/465767845233456.jpg
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);


            //GUARDAR cambios
           
            // $usuario->email = $request->email;
            //?? null dice k puede  estar vacio en immagen
            //auth... es para k guarde la imagen 
            $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
            

            //REDIRECCIONAR
            //si modifico o subio una foto lo redirecccionamos a su perfil
            //y si  cambio su usernname = es x ello k le ponemos usuario->username
            
        }
        $usuario->save();
        return redirect()->route('posts.index', $usuario->username);
    }
}
