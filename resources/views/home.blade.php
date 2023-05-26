@extends('layouts.app')

@section('titulo')
    Pagina principal
@endsection

@section('contenido')

    {{-- cuando creamos un componente crea siempre 2 archivos --}}
    <x-listar-post :posts="$posts" />
    {{-- este es uun componente funciona conn la palabra sllot 
    <x-listar-post>
        
        <x-slot:titulo>
        <h6>soy un slot con nombre</h6>
        </x-slot:titulo>
    
        <h1>mostardo el resultado echo en la vista home</h1>
    </x-listar-post> --}}

    
{{-- @section('contenido')
   @if ( $posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post )
                <div>
                    <a href="{{  route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads'). '/' . $post->imagen }}" alt="imagen del post {{ $post->titulo}}">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{ $posts->links('pagination::tailwind')}}
        </div>
   @else
       <p class="text-center">No hay post</p>
   @endif --}}
@endsection
