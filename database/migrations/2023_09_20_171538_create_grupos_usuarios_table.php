<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grupo_id');
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos_usuarios');
    }
}
