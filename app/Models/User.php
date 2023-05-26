<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //fillable son los datos k esperamos k nos de el usuario
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //es una relacion de one of many
    //es uno a muchos donde un usuario puede tener varios post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    //relacion de un usuario puede tenr muchos likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Almacena los seguidores de un usuario
    //no olvidar colocar los datos en el modelo de follower
    //la relacion es de muchos, aqui nos sallimos de las convenciones 
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    //almacenar los usuarios  que seguimos
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id',);
    }

    //comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user)
    {
        //followers = es le metodo de arriba
        //contains = para ver si ya lo contiene
        //este user es el nos esta siguiendo
        return $this->followers->contains( $user->id );
    }
}
