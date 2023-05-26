<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        //para ver  todos los request
        // $input = $request->all();
        //para que nos de el file ya k el otro no lo arrogaba
        $imagen1 = $request->file('file');

        //para que las img k suban teengan un unico id
        $nombreImagen = Str::uuid() . "." . $imagen1->extension();

        //es para guardarla x lo mientras solo lo guarda en memoria
        $imagenServidor = Image::make($imagen1);
        //fit es cuadrado y cuanto va a medir
        $imagenServidor->fit(1000, 1000);

        //en este apartado se guardaran las imagenes en la carpeta uploads
        //la "/" es para que se vea algo asi uploads/465767845233456.jpg
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        //json para k lo cobierta en un arreglo y es una forma de comicar el back con el front
        //nos arroje la extension del file (jpg etc)
        return response()->json(['imagen' => $nombreImagen ]);
    }
}
