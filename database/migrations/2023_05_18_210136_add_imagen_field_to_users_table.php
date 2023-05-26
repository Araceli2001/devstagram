<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Esta migracion ees para cuanddo el usuario sube su foto de perfil
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //a la tabla le agregamos la columna imagen
            //el nullable quiere decir k el campo puede  ir vacio
            $table->string('imagen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //por si le damos un rollback eliminamos solo la  columna de imagen 
            $table->dropColumn('imagen');
        });
    }
};
