<?php

use App\RespuestasPrueba;
use Illuminate\Database\Seeder;

class RespuestasPruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RespuestasPrueba::create([
            'id_pregunta' => 1,
            'id_alternativa_correcta' => 2
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 2,
        'id_alternativa_correcta' => 7
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 3,
        'id_alternativa_correcta' => 9
       ]);       

       RespuestasPrueba::create([
        'id_pregunta' => 4,
        'id_alternativa_correcta' => 15
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 5,
        'id_alternativa_correcta' => 17
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 6,
        'id_alternativa_correcta' => 22
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 7,
        'id_alternativa_correcta' => 24
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 8,
        'id_alternativa_correcta' => 29
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 9,
        'id_alternativa_correcta' => 33
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 10,
        'id_alternativa_correcta' => 37
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 11,
        'id_alternativa_correcta' => 38
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 12,
        'id_alternativa_correcta' => 43
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 13,
        'id_alternativa_correcta' => 48
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 14,
        'id_alternativa_correcta' => 49
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 15,
        'id_alternativa_correcta' => 53
       ]);


       RespuestasPrueba::create([
        'id_pregunta' => 16,
        'id_alternativa_correcta' => 58
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 17,
        'id_alternativa_correcta' => 61
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 18,
        'id_alternativa_correcta' => 62
       ]);

       RespuestasPrueba::create([
        'id_pregunta' => 19,
        'id_alternativa_correcta' => 67
       ]);
    }
}
