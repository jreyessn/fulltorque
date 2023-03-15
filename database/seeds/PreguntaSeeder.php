<?php

use App\Alternativa;
use App\Pregunta;
use App\PruebaRendidaUsuario;
use App\RespuestasPrueba;
use App\RespuestasUsuario;
use App\Temarios;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Temarios::truncate();
        Pregunta::truncate();
        Alternativa::truncate();
        RespuestasPrueba::truncate();
        PruebaRendidaUsuario::truncate();
        RespuestasUsuario::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $temarios = [
            'Torque Hidráulico',
            'Levante Hidráulico',
            'Torque Manual',
            'Torque Neumático',
            'Impacto',
        ];
        
        foreach ($temarios as $tema) {
            Temarios::firstOrCreate([
                'name' => $tema,
                "prueba_id" => 1
            ]);
        }

        $preguntas = [
            [
                "enunciado_pregunta" => "Un perno torqueado a 1.216 [Lb.Pie] con una llave de torque hidráulico 3 MXT. ¿A cuánta presión [PSI] se requiere regular la bomba?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [
                    [
                        "descripcion_alternativa" => "5.000 PSI",
                    ],
                    [
                        "descripcion_alternativa" => "3.800 PSI",
                        "correcta" => true
                    ],
                    [
                        "descripcion_alternativa" => "4.200 PSI",
                    ],
                    [
                        "descripcion_alternativa" => "Ninguna de las anteriores",
                    ],
                ]
            ],
            [
                "enunciado_pregunta" => "¿A qué magnitud física está asociada la unidad [PSI]?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Torque",    
                    ],
                    [   
                        "descripcion_alternativa" => "Fuerza",    
                    ],
                    [        
                        "descripcion_alternativa" => "Presión",        
                        "correcta" => true,    
                    ],
                    [  
                        "descripcion_alternativa" => "Temperatura",    
                    ],
               ]
            ],            
            [
                "enunciado_pregunta" => "¿A qué magnitud física está asociada la unidad [Lb.Pie]?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Torque",
                        "correcta" => true    
                    ],
                    [        
                        "descripcion_alternativa" => "Fuerza",
                    ],
                    [        
                        "descripcion_alternativa" => "Presion",
                    ],
                    [        
                        "descripcion_alternativa" => "Temperatura",
                    ],
                ]
            ],
            [
                "enunciado_pregunta" => "¿A qué capacidad se recomienda usar una herramienta?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "90%",    
                    ],
                    [        
                        "descripcion_alternativa" => "100%",    
                    ],
                    [        
                        "descripcion_alternativa" => "80%",    
                        "correcta" => true    
                    ],
                    [        
                        "descripcion_alternativa" => "60%",    
                    ],
                ]
            ],            
            [
                "enunciado_pregunta" => "Si la llave de torque hidráulico se atora ¿Cuál es el procedimiento para retirarla?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Presionar “acción” en la bomba, levantar las lever y soltar el botón de la bomba",        
                        "correcta" => true    
                    ],
                    [        
                        "descripcion_alternativa" => "Regular a máxima presión, accionar y hacer girar la llave, luego levantar las lever"    
                    ],
                    [        
                        "descripcion_alternativa" => "Realizar palanca con otra herramienta"    
                    ]
                ]
            ],
            [
                "enunciado_pregunta" => "¿Qué grado de aceite utiliza la bomba electrohidráulica para equipos de torque?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Grado 32",    
                    ],
                    [        
                        "descripcion_alternativa" => "Grado 68",    
                    ],
                    [        
                        "descripcion_alternativa" => "Grado 46",
                        "correcta" => true    
                    ],
                    [        
                        "descripcion_alternativa" => "Grado 40",    
                    ],
                ]
            ],
            [
                "enunciado_pregunta" => "¿Cada cuánto tiempo se recomienda reemplazar el aceite de la bomba?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "6 meses o 40 horas",
                        "correcta" => true
                    ],
                    [        
                        "descripcion_alternativa" => "4 meses"    
                    ],
                    [        
                        "descripcion_alternativa" => "1 año"    
                    ],
                    [        
                        "descripcion_alternativa" => "2 meses"    
                    ]
                ]
            ],
            [
                "enunciado_pregunta" => "¿Cómo se deben conectar los acoples hidráulicos?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Roscar completamente y asegurar apriete con herramientas manuales",    
                    ],
                    [        
                        "descripcion_alternativa" => "Limpiar y roscar completamente de forma manual",
                        "correcta" => true    
                    ],
                    [        
                        "descripcion_alternativa" => "Limpiar y roscar completamente con herramienta manual",    
                    ],
                ]

            ],
            [
                "enunciado_pregunta" => "¿Qué tipo de dado se utiliza con equipos de torque hidráulico?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [       
                        "descripcion_alternativa" => "Cromados",    
                    ],
                    [       
                        "descripcion_alternativa" => "Dados de Impacto", 
                        "correcta" => true  
                    ],
                    [       
                        "descripcion_alternativa" => "Cromados y de impacto",    
                    ],
                    [       
                        "descripcion_alternativa" => "Ninguna de las anteriores",    
                    ],
                ]

            ],
            [
                "enunciado_pregunta" => "¿Se pueden utilizar extensiones y adaptadores en equipos de torque hidráulico?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Siempre",    
                    ],
                    [        
                        "descripcion_alternativa" => "Dependiendo de la aplicacion",    
                    ],
                    [        
                        "descripcion_alternativa" => "Nunca",
                        "correcta" => true    
                    ],
                ]

            ],
            [
                "enunciado_pregunta" => "¿Cómo se regula la presión en la bomba de torque hidráulico?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "De forma ascendente",   
                        "correcta" => true 
                    ],
                    [        
                        "descripcion_alternativa" => "De forma descendente",    
                    ],
                    [        
                        "descripcion_alternativa" => "No importa como regular",    
                    ],
                ]
            
            ],
            [
                "enunciado_pregunta" => "¿En cuáles unidades está graduado el manómetro de una bomba para equipos de torque?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [       
                        "descripcion_alternativa" => "PSI",    
                    ],
                    [       
                        "descripcion_alternativa" => "BAR",    
                    ],
                    [       
                        "descripcion_alternativa" => "BAR y PSI",   
                        "correcta" => true 
                    ],
                    [       
                        "descripcion_alternativa" => "PSI y Lb.pie",    
                    ],
                ]
            
            ],
            [
                "enunciado_pregunta" => "¿Para qué sirve el visor de la bomba de torque?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Visualizar nivel",    
                    ],
                    [        
                        "descripcion_alternativa" => "Visualizar temperatura",    
                    ],
                    [        
                        "descripcion_alternativa" => "Visualizar estado del aceite",    
                    ],
                    [        
                        "descripcion_alternativa" => "Todas las anteriores",  
                        "correcta" => true   
                    ],
                ]

            ],
            [
                "enunciado_pregunta" => "¿Cómo es la configuración de acoples de la manguera?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Macho-Macho y Hembra-Hembra",   
                        "correcta" => true  
                    ],
                    [        
                        "descripcion_alternativa" => "Macho-Hembra y Macho-Hembra",    
                    ],
                    [        
                        "descripcion_alternativa" => "Ninguna de las anteriores",    
                    ],
                ]
            ],
            [
                "enunciado_pregunta" => "¿En bombas manuales se puede utilizar extensión para el brazo de bombeo?",
                "temario_id" => Temarios::where("name", "Torque Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "SI",    
                    ],
                    [        
                        "descripcion_alternativa" => "No",    
                        "correcta" => true 
                    ],
                    [        
                        "descripcion_alternativa" => "Solo si el brazo es de fierro",    
                    ],
                    [        
                        "descripcion_alternativa" => "Cuando el trabajo lo permita",    
                    ],
                ]
            ],
            [
                "enunciado_pregunta" => "¿Para qué sirven los cilindros hidráulicos?",
                "temario_id" => Temarios::where("name", "Levante Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Levantar y sostener carga",    
                    ],
                    [        
                        "descripcion_alternativa" => "Sostener carga",    
                    ],
                    [        
                        "descripcion_alternativa" => "Solo para levantar carga",   
                        "correcta" => true  
                    ],
                ]
            ],
            [
                "enunciado_pregunta" => "¿Para qué sirve la silleta en el cilindro?",
                "temario_id" => Temarios::where("name", "Levante Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Proteger el vástago",    
                    ],
                    [        
                        "descripcion_alternativa" => "Distribuir la carga de manera uniforme",    
                    ],
                    [        
                        "descripcion_alternativa" => "Todas las anteriores",  
                        "correcta" => true   
                    ],
                ]
            ],
            [
                "enunciado_pregunta" => "¿Qué significa la ley del 80% en los cilindros?",
                "temario_id" => Temarios::where("name", "Levante Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Usar el 80% de carga y 80% de carrera", 
                        "correcta" => true    
                    ],
                    [        
                        "descripcion_alternativa" => "Usar 80% de carga y 100% de carrera",    
                    ],
                    [        
                        "descripcion_alternativa" => "Todas las anteriores",    
                    ],
                ]
            ],
            [
                "enunciado_pregunta" => "¿Cuándo se puede mezclar acoples de espiga y bola en un sistema?",
                "temario_id" => Temarios::where("name", "Levante Hidráulico")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Cuando el trabajo lo permita",    
                    ],
                    [        
                        "descripcion_alternativa" => "Siempre",    
                    ],
                    [        
                        "descripcion_alternativa" => "Nunca",    
                        "correcta" => true 
                    ],
                    [        
                        "descripcion_alternativa" => "Cuando esten presentes en el equipo",    
                    ],
                ]
            ],
            [
                "enunciado_pregunta" => "¿Qué acción se puede realizar con el torquímetro manual?",
                "temario_id" => Temarios::where("name", "Torque Manual")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Soltura de pernos o tuercas",    
                    ],
                    [        
                        "descripcion_alternativa" => "Solo apriete de pernos y tuercas",    
                        "correcta" => true 
                    ],
                    [        
                        "descripcion_alternativa" => "Acercar al torque deseado",    
                    ],
                    [        
                        "descripcion_alternativa" => "Solo soltura de pernos o tuercas",    
                    ],
                ]
            ],
            [
                "enunciado_pregunta" => "¿Qué significa la ley del 80% en los equipos?",
                "temario_id" => Temarios::where("name", "Torque Neumático")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Usar solamente hasta el 80% de capacidad máxima",
                        "correcta" => true     
                    ],
                    [        
                        "descripcion_alternativa" => "Usar sobre el 80% de su capacidad",    
                    ],
                ]


            ],
            [
                "enunciado_pregunta" => "¿Cuál es la presión máxima de trabajo en equipos neumáticos?",
                "temario_id" => Temarios::where("name", "Torque Neumático")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "98 PSI",    
                    ],
                    [        
                        "descripcion_alternativa" => "100 PSI",    
                    ],
                    [        
                        "descripcion_alternativa" => "90 PSI",    
                        "correcta" => true 
                    ],
                    [        
                        "descripcion_alternativa" => "Ninguna de las anteriores",    
                    ],
                ]

            ],
            [
                "enunciado_pregunta" => "¿Qué significan las siglas F.R.L.?",
                "temario_id" => Temarios::where("name", "Torque Neumático")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Filtro, Regulador y Lubricador",   
                        "correcta" => true  
                    ],
                    [        
                        "descripcion_alternativa" => "Facilitar Regulación de lubricación",    
                    ],
                    [        
                        "descripcion_alternativa" => "Filtrar y Regular",    
                    ],
                ]
            ],
            [
                "enunciado_pregunta" => "¿Cuántos segundos como máximo se debe usar una llave de impacto?",
                "temario_id" => Temarios::where("name", "Impacto")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "10 segundos",    
                        "correcta" => true 
                    ],
                    [        
                        "descripcion_alternativa" => "30 segundos",    
                    ],
                    [        
                        "descripcion_alternativa" => "Hasta que suelte el perno",    
                    ],
                    [        
                        "descripcion_alternativa" => "Ninguna de las anteriores",    
                    ],
                ]
            ],
            [
                "enunciado_pregunta" => "¿Cuánto es el siclo de trabajo continuo de una llave de impacto a batería?",
                "temario_id" => Temarios::where("name", "Impacto")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Dos cargas completas de las baterías",   
                        "correcta" => true  
                    ],
                    [        
                        "descripcion_alternativa" => "1 hora",    
                    ],
                    [        
                        "descripcion_alternativa" => "Hasta que se queme",    
                    ],
                ]
            ],
            [
                "enunciado_pregunta" => "¿Qué acción se puede realizar con una llave de impacto?",
                "temario_id" => Temarios::where("name", "Impacto")->first()->id ?? null,
                "respuestas" => [    
                    [        
                        "descripcion_alternativa" => "Soltura de pernos o tuercas y acercar al torque deseado",    
                        "correcta" => true 
                    ],
                    [        
                        "descripcion_alternativa" => "Solo apriete de pernos y tuercas",    
                    ],
                    [        
                        "descripcion_alternativa" => "Acercar al torque deseado",    
                    ],
                    [        
                        "descripcion_alternativa" => "Solo soltura de pernos o tuercas",    
                    ],
                ]
            ],
            
        ];

        foreach ($preguntas as $key => $pregunta) {
            $preguntaModel = Pregunta::create([
                'numero_pregunta_prueba' => $key + 1,
                'id_prueba' => 1,
                'id_tipo_pregunta' => 1,
                'id_respuesta_pregunta' => 1,
                "temario_id"         => $pregunta["temario_id"],
                'enunciado_pregunta' => $pregunta["enunciado_pregunta"]
            ]);

            foreach ($pregunta["respuestas"] as $respuesta) {
                $alternativaModel = Alternativa::create([
                    "id_pregunta" => $preguntaModel->id,
                    "descripcion_alternativa" => $respuesta["descripcion_alternativa"]
                ]);

                if($respuesta["correcta"] ?? false){
                    RespuestasPrueba::create([
                        "id_pregunta" => $preguntaModel->id,
                        "id_alternativa_correcta" => $alternativaModel->id
                    ]);
                }

            }

        }
        
    }
}
