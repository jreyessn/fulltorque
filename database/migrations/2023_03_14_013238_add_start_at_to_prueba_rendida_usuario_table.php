<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartAtToPruebaRendidaUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prueba_rendida_usuarios', function (Blueprint $table) {
            $table->timestamp("start_at")->after("id_prueba")->nullable();
            $table->timestamp("end_at")->after("start_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prueba_rendida_usuarios', function (Blueprint $table) {
            $table->dropColumn(["start_at", "end_at"]);
        });
    }
}
