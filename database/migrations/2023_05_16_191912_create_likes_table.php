<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    // es una relacion de muchos a muchos es la que se va a utilozar
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            //necesitamos el user id del k me dda me gusta
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //el post del k se esta danndo like
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
