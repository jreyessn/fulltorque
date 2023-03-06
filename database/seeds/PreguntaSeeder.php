<?php

use App\Pregunta;
use Illuminate\Database\Seeder;

class PreguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pregunta::create([
            'numero_pregunta_prueba' => 1,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => 'Un perno torqueado a 1.216 [Lb.Pie] con una llave de torque hidraulico 3 MXT. ¿A cuanta Presion [PSI] se requiere regular la bomba?'
        ]);
        
        Pregunta::create([
            'numero_pregunta_prueba' => 2,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿A que magnitud fisica está asociada la unidad [PSI]?'
        ]);  

        Pregunta::create([
            'numero_pregunta_prueba' => 3,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿A que magnitud fisica está asociada la unidad [Lb.Pie]?'
        ]);  

        Pregunta::create([
            'numero_pregunta_prueba' => 4,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿A que capacidad se recomienda usar una herramienta?'
        ]);        

        Pregunta::create([
            'numero_pregunta_prueba' => 5,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => 'Si la llave de torque hidráulico se atora ¿Cuál es el procedimiento para retirarla?'
        ]);     

        Pregunta::create([
            'numero_pregunta_prueba' => 6,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿Qué grado de aceite utiliza la bomba eléctrohidraulica de torque?'
        ]);     

        Pregunta::create([
            'numero_pregunta_prueba' => 7,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿Cada cuanto tiempo se recomienda reemplazar el aceite de la bomba?'
        ]);      

        Pregunta::create([
            'numero_pregunta_prueba' => 8,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿Cómo se deben conectar los acoples hidraulicos?'
        ]);    

        Pregunta::create([
            'numero_pregunta_prueba' => 9,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿Qué tipo de dado se utiliza con equipos de torque hidraulico?'
        ]);
        Pregunta::create([
            'numero_pregunta_prueba' => 10,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿Se pueden utilizar extensiones y adaptadores en equipos de troque hidráulico?'
        ]);
        Pregunta::create([
            'numero_pregunta_prueba' => 11,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿Cómo se regula la presión en la bomba de torque hidráulico?'
        ]);
        Pregunta::create([
            'numero_pregunta_prueba' => 12,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿En que unidades está graduado el manometro de una bomba de torque?'
        ]);
        Pregunta::create([
            'numero_pregunta_prueba' => 13,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿Para que sirve el visor de la bomba de torque?'
        ]);
        Pregunta::create([
            'numero_pregunta_prueba' => 14,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿Cómo es la configuracion de acoples de la manguera?'
        ]);
        Pregunta::create([
            'numero_pregunta_prueba' => 15,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿En bombas manuales se puede utilizar extensión para el brazo de bome?'
        ]);


        Pregunta::create([
            'numero_pregunta_prueba' => 16,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿Para que sirven los cilindros hidraulicos?'
        ]);


        Pregunta::create([
            'numero_pregunta_prueba' => 17,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿Para que sirve la silleta en el cilindro?'
        ]);

        Pregunta::create([
            'numero_pregunta_prueba' => 18,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿Qué significa la ley del 80% en los cilindros?'
        ]);

        Pregunta::create([
            'numero_pregunta_prueba' => 19,
            'id_prueba' => 1,
            'id_tipo_pregunta' => 1,
            'id_respuesta_pregunta' => 1,
            'enunciado_pregunta' => '¿Cuándo puedo mezclar acoples de espiga y bola en un sistema?'
        ]);
    }
}
