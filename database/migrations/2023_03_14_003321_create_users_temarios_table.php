<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTemariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_temarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->unsignedBigInteger("temario_id");
            $table->foreign("temario_id")->on("temarios")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_temarios');
    }
}
