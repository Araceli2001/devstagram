<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //un post puede tener un solo usuario
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    //es una relacion para que un post tenga multiples comentarios
    public function comentarios()
    {
        return $this->hasMany(comentario::class);
    }
    
    //es una relacion para los likes un post puede tener muchos likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //no duplicados para los likes
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
}
