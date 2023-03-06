<?php

use App\EncabezadoPrueba;
use Illuminate\Database\Seeder;

class EncabezadoPruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EncabezadoPrueba::create([
            'id_prueba' => 1,
            'titulo_prueba' => 'EVALUACIÓN DE CONOCIMIENTOS',
            'descripcion_prueba' => 'CAPACITACIÓN Y/O ADIESTRAMIENTO EN EQUIPOS HIDRÁULICOS DE TORQUE'
        ]);
    }
}
