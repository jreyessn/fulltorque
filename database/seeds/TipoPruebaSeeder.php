<?php

use App\TipoPrueba;
use Illuminate\Database\Seeder;

class TipoPruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoPrueba::create([
            'descripcion_tipo_prueba' => 'Evaluación de conocimientos',
       ]);
    }
}
