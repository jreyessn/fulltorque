<?php

use App\Prueba;
use Illuminate\Database\Seeder;

class PruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prueba::create([
            'id_encabezado_prueba' => 1,
            'id_tipo_prueba' => 1,
            'id_estado_prueba' => 1
       ]);
    }
}
