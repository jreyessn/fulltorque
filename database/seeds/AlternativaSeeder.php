<?php

use App\Alternativa;
use Illuminate\Database\Seeder;

class AlternativaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        Alternativa::create([
            'id_pregunta' => 1,
            'descripcion_alternativa' => '5.000 PSI'
        ]);
        //2
        Alternativa::create([
            'id_pregunta' => 1,
            'descripcion_alternativa' => '3.800 PSI'
        ]);
        //3
        Alternativa::create([
            'id_pregunta' => 1,
            'descripcion_alternativa' => '4.200 PSI'
        ]);
        //4
        Alternativa::create([
            'id_pregunta' => 1,
            'descripcion_alternativa' => 'Ninguna de las anteriores'
        ]);

        //PREGUNTA 2
        //5
        Alternativa::create([
            'id_pregunta' => 2,
            'descripcion_alternativa' => 'Torque'
        ]);
        //6
        Alternativa::create([
            'id_pregunta' => 2,
            'descripcion_alternativa' => 'Fuerza'
        ]);
        //7
        Alternativa::create([
            'id_pregunta' => 2,
            'descripcion_alternativa' => 'Presión'
        ]);
        //8
        Alternativa::create([
            'id_pregunta' => 2,
            'descripcion_alternativa' => 'Temperatura'
        ]);

        //PREGUNTA 3
        //9
        Alternativa::create([
            'id_pregunta' => 3,
            'descripcion_alternativa' => 'Torque'
        ]);
        //10
        Alternativa::create([
            'id_pregunta' => 3,
            'descripcion_alternativa' => 'Fuerza'
        ]);
        //11
        Alternativa::create([
            'id_pregunta' => 3,
            'descripcion_alternativa' => 'Presión'
        ]);
        //12
        Alternativa::create([
            'id_pregunta' => 3,
            'descripcion_alternativa' => 'Temperatura'
        ]);

        //PREGUNTA 4
        //13
        Alternativa::create([
            'id_pregunta' => 4,
            'descripcion_alternativa' => '90%'
        ]);
        //14
        Alternativa::create([
            'id_pregunta' => 4,
            'descripcion_alternativa' => '100%'
        ]);
        //15
        Alternativa::create([
            'id_pregunta' => 4,
            'descripcion_alternativa' => '80%'
        ]);
        //16
        Alternativa::create([
            'id_pregunta' => 4,
            'descripcion_alternativa' => '60%'
        ]);

        //PREGUNTA 5
        //17
        Alternativa::create([
            'id_pregunta' => 5,
            'descripcion_alternativa' => 'Presionar “accion” en la bomba, levantar las lever y soltar el boton de la bomba'
        ]);
        //18
        Alternativa::create([
            'id_pregunta' => 5,
            'descripcion_alternativa' => 'Regular a maxima presion, accionar y hacer girar la llave, luego levantar las lever'
        ]);
        //19
        Alternativa::create([
            'id_pregunta' => 5,
            'descripcion_alternativa' => 'Realizar palanca con otra herramienta.'
        ]);

        //PREGUNTA 6
        //20
        Alternativa::create([
            'id_pregunta' => 6,
            'descripcion_alternativa' => 'Grado 32'
        ]);
        //21
        Alternativa::create([
            'id_pregunta' => 6,
            'descripcion_alternativa' => 'Grado 68'
        ]);
        //22
        Alternativa::create([
            'id_pregunta' => 6,
            'descripcion_alternativa' => 'Grado 46'
        ]);
        //23
        Alternativa::create([
            'id_pregunta' => 6,
            'descripcion_alternativa' => 'Grado 40'
        ]);

        //PREGUNTA 7
        //24
        Alternativa::create([
            'id_pregunta' => 7,
            'descripcion_alternativa' => '6 meses o 40 horas'
        ]);
        //25
        Alternativa::create([
            'id_pregunta' => 7,
            'descripcion_alternativa' => '4 meses'
        ]);
        //26
        Alternativa::create([
            'id_pregunta' => 7,
            'descripcion_alternativa' => '1 año'
        ]);
        //27
        Alternativa::create([
            'id_pregunta' => 7,
            'descripcion_alternativa' => '2 meses'
        ]);

        //PREGUNTA 8
        //28
        Alternativa::create([
            'id_pregunta' => 8,
            'descripcion_alternativa' => 'Roscar completamente y asegurar apriete con herramientas manuales.'
        ]);
        //29
        Alternativa::create([
            'id_pregunta' => 8,
            'descripcion_alternativa' => 'Limpiar y roscar completamente de forma manual.'
        ]);
        //30
        Alternativa::create([
            'id_pregunta' => 8,
            'descripcion_alternativa' => 'Limpiar y roscar completamente con herramienta manual.'
        ]);

        //PREGUNTA 9
        //31
        Alternativa::create([
            'id_pregunta' => 9,
            'descripcion_alternativa' => 'Cromados'
        ]);
        //32
        Alternativa::create([
            'id_pregunta' => 9,
            'descripcion_alternativa' => 'Cromados y de impacto'
        ]);
        //33
        Alternativa::create([
            'id_pregunta' => 9,
            'descripcion_alternativa' => 'Dados de impacto'
        ]);
        //34
        Alternativa::create([
            'id_pregunta' => 9,
            'descripcion_alternativa' => 'Ninguna de las anteriores'
        ]);

        //PREGUNA 10
        //35
        Alternativa::create([
            'id_pregunta' => 10,
            'descripcion_alternativa' => 'Siempre'
        ]);
        //36
        Alternativa::create([
            'id_pregunta' => 10,
            'descripcion_alternativa' => 'Dependiendo de la aplicacion'
        ]);
        //37
        Alternativa::create([
            'id_pregunta' => 10,
            'descripcion_alternativa' => 'Nunca'
        ]);
       

        //PREGUNA 11
        //38
        Alternativa::create([
            'id_pregunta' => 11,
            'descripcion_alternativa' => 'De forma ascendente'
        ]);
        //39
        Alternativa::create([
            'id_pregunta' => 11,
            'descripcion_alternativa' => 'De forma descendente'
        ]);
        //40
        Alternativa::create([
            'id_pregunta' => 11,
            'descripcion_alternativa' => 'No importa como regular'
        ]);

        //PREGUNA 12
        //41
        Alternativa::create([
            'id_pregunta' => 12,
            'descripcion_alternativa' => 'PSI'
        ]);
        //42
        Alternativa::create([
            'id_pregunta' => 12,
            'descripcion_alternativa' => 'BAR'
        ]);
        //43
        Alternativa::create([
            'id_pregunta' => 12,
            'descripcion_alternativa' => 'BAR y PSI'
        ]);
        //44
        Alternativa::create([
            'id_pregunta' => 12,
            'descripcion_alternativa' => 'PSI y Lb.pie'
        ]);

        //PREGUNA 13
        //45
        Alternativa::create([
            'id_pregunta' => 13,
            'descripcion_alternativa' => 'Visualizar nivel '
        ]);
        //46
        Alternativa::create([
            'id_pregunta' => 13,
            'descripcion_alternativa' => 'Visualizar temperatura '
        ]);
        //47
        Alternativa::create([
            'id_pregunta' => 13,
            'descripcion_alternativa' => 'Visualizar estado del aceite'
        ]);
        //48
        Alternativa::create([
            'id_pregunta' => 13,
            'descripcion_alternativa' => 'Todas las anteriores'
        ]);


        //PREGUNA 14
        //49
        Alternativa::create([
            'id_pregunta' => 14,
            'descripcion_alternativa' => 'Macho-Macho y Hembra-Hembra'
        ]);
        //50
        Alternativa::create([
            'id_pregunta' => 14,
            'descripcion_alternativa' => 'Macho-Hembra y Macho-Hembra'
        ]);
        //51
        Alternativa::create([
            'id_pregunta' => 14,
            'descripcion_alternativa' => 'Ninguna de las anteriores'
        ]);
       

        //PREGUNA 15
        //52
        Alternativa::create([
            'id_pregunta' => 15,
            'descripcion_alternativa' => 'Si'
        ]);
        //53
        Alternativa::create([
            'id_pregunta' => 15,
            'descripcion_alternativa' => 'No'
        ]);
        //54
        Alternativa::create([
            'id_pregunta' => 15,
            'descripcion_alternativa' => 'Solo si el brazo es de fierro'
        ]);
        //55
        Alternativa::create([
            'id_pregunta' => 15,
            'descripcion_alternativa' => 'Cuando el trabajo lo permita'
        ]);



        //PREGUNA 16
        //56
        Alternativa::create([
            'id_pregunta' => 16,
            'descripcion_alternativa' => 'Levantar y sostener carga'
        ]);
        //57
        Alternativa::create([
            'id_pregunta' => 16,
            'descripcion_alternativa' => 'Sostener carga'
        ]);
        //58
        Alternativa::create([
            'id_pregunta' => 16,
            'descripcion_alternativa' => 'Solo para levantar carga'
        ]);
       




        //PREGUNA 17
        //59
        Alternativa::create([
            'id_pregunta' => 17,
            'descripcion_alternativa' => 'Proteger el vastago'
        ]);
        //60
        Alternativa::create([
            'id_pregunta' => 17,
            'descripcion_alternativa' => 'Distribuir la carga de manera uniforme'
        ]);
        //61
        Alternativa::create([
            'id_pregunta' => 17,
            'descripcion_alternativa' => 'Todas las anteriores'
        ]);
       



        //PREGUNA 18
        //62
        Alternativa::create([
            'id_pregunta' => 18,
            'descripcion_alternativa' => '80% de carga y 80% de carrera'
        ]);
        //63
        Alternativa::create([
            'id_pregunta' => 18,
            'descripcion_alternativa' => '80% de carga y 100% de carrera'
        ]);
        //64
        Alternativa::create([
            'id_pregunta' => 18,
            'descripcion_alternativa' => 'Todas las anteriores'
        ]);
      



        //PREGUNA 19
        //65
        Alternativa::create([
            'id_pregunta' => 19,
            'descripcion_alternativa' => 'Cuando el trabajo lo permita'
        ]);
        //66
        Alternativa::create([
            'id_pregunta' => 19,
            'descripcion_alternativa' => 'Siempre'
        ]);
        //67
        Alternativa::create([
            'id_pregunta' => 19,
            'descripcion_alternativa' => 'Nunca'
        ]);
        //68
        Alternativa::create([
            'id_pregunta' => 19,
            'descripcion_alternativa' => 'Cuando esten presentes en el equipo'
        ]);
    }
}
