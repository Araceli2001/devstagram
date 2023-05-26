<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use GuzzleHttp\Promise\Create;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/crear-cuenta', function () {
//     return view('auth.register');
// });

//es la ruta de home
Route::get('/', HomeController::class)->name('home');

//Rutas para el perfil---- 1
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
//---2
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

//si tiene la misma ruta solo se le puede dejar un name, xk hay k recordar el la ruta 2 si no tiene name va a tomar el de arriba
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
//cerrar sesion
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//para que suba fotos el usuario
Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
//para ver las publicaciiones esa variable de post va en el controlados y en la vista
Route::get('{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
//para los ccomentrios de los posts
Route::post('{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
//para elimminnar commentario
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('posts.destroy');



//ruta k los  usuarios usban sus imagenes
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');
 
//likes de las  fotos
Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');

//eliminar likes
Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

//para k aparesca el nombre del usuario en la ruta
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');

//siguiendo a Usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');