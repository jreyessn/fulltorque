<?php

use App\EstadoPrueba;
use Illuminate\Database\Seeder;

class EstadoPruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoPrueba::create([
            'descripcion_estado_prueba' => 'Sin Desarrollar'
        ]);
    }
}
