<?php

namespace App\Http\Controllers;

use App\Alternativa;
use App\EncabezadoPrueba;
use App\Pregunta;
use App\Prueba;
use App\PruebaRendidaUsuario;
use App\RespuestasPrueba;
use App\RespuestasUsuario;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Prueba::all());  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prueba  $prueba
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Prueba::findOrFail($id);
    }


    public function getPruebasDetalladas()
    {
        $lista_pruebas_detalladas = [];
        $listado_pruebas = Prueba::all();

        foreach ($listado_pruebas as $prueba){

            //definicion de id_prueba en objeto de retorno prueba_detallada
            $prueba_detallada['id_prueba'] = $prueba['id'];  

            //consulta a la base de datos para encabezado

            $encabezado_prueba = EncabezadoPrueba::where('id_prueba', $prueba['id'])->get()->first();
            $prueba_detallada['encabezado_prueba'] = $encabezado_prueba->titulo_prueba;

            $lista_pruebas_detalladas[]=$prueba_detallada;
        }   

        return response()->json($lista_pruebas_detalladas);
    }

    public function findPruebaDetallada($id)
    {
        $prueba = Prueba::findOrFail($id);

            //definicion de id_prueba en objeto de retorno prueba_detallada
            $prueba_detallada['id_prueba'] = $prueba['id'];           
            //consulta a la base de datos para encabezado
            $encabezado_prueba = DB::table('encabezado_pruebas')->where('id', '=', $prueba['id_encabezado_prueba'])->first();
            //consulta de tipo de prueba
            $tipo_prueba = DB::table('tipo_pruebas')->where('id', '=', $prueba['id_tipo_prueba'])->first();
            //consutla por estado de prueba
            $estado_prueba = DB::table('estado_pruebas')->where('id', '=', $prueba['id_estado_prueba'])->first();
            //añadiendo variables a la prueba_detallada
            $prueba_detallada['prueba_encabezado_titulo'] = $encabezado_prueba->titulo_prueba;
            $prueba_detallada['prueba_encabezado_descripcion'] = $encabezado_prueba->descripcion_prueba;
            $prueba_detallada['tipo_prueba'] = $tipo_prueba->descripcion_tipo_prueba;
            $prueba_detallada['estado_prueba'] = $estado_prueba->descripcion_estado_prueba;

        return response()->json($prueba_detallada); 
    }


    public function getResultadoPrueba($id)
    {
        $user   = request()->user();
        $preguntas_prueba = Pregunta::where('id_prueba',$id)->when($user, function($query) use ($user){
            $query->whereIn("temario_id", $user->temarios->pluck("id"));
        })->get();
        $cant_preguntas_prueba = $preguntas_prueba->count();
        $respuestas_correctas = 0;

        foreach ($preguntas_prueba as $pregunta){

            $id_pregunta = $pregunta['id'];
            $respuesta_pregunta  = RespuestasPrueba::where('id_pregunta', $id_pregunta)->get()->first();
            $respuesta_usuario = RespuestasUsuario::where('id_pregunta', $id_pregunta)->where('id_usuario', Auth::user()->id)->get()->first();

            if (isset($respuesta_usuario)) {
                if($respuesta_pregunta['id_alternativa_correcta'] == $respuesta_usuario['id_alternativa']){
                    $respuestas_correctas++;
                }
            }
            
            
            

        }
        $respuestas_usuario = RespuestasUsuario::where('id_prueba', $id)->where('id_usuario', Auth::user()->id)->get()->count();

        $resultado_prueba['cantidad_preguntas'] = $cant_preguntas_prueba;
        $resultado_prueba['respuestas_usuario'] = $respuestas_usuario;
        $resultado_prueba['respuestas_correctas'] = $respuestas_correctas;
        $res=[];
        $res[] = $resultado_prueba;

        return response()->json($res);
    }

    public function getResultadoOnePrueba($id_prueba_rendida_usuario = null)
    {
        $preguntas_prueba = DB::select("
            SELECT 
                p.id,
                u.name,
                (
                    SELECT COUNT(id) 
                    FROM preguntas 
                    WHERE preguntas.id_prueba = p.id_prueba
                    AND preguntas.temario_id in (
                        SELECT temario_id
                        FROM users_temarios
                        WHERE users_temarios.user_id = u.id
                    )
                ) as total_preguntas,
                COUNT(rp.id_pregunta) AS total_respuestas,
                SUM(rp.id_alternativa_correcta = ru.id_alternativa) AS respuestas_correctas,
                SUM(rp.id_alternativa_correcta != ru.id_alternativa) AS respuestas_incorrectas,
                (SUM(rp.id_alternativa_correcta = ru.id_alternativa) / COUNT(rp.id_pregunta)) * 100 AS porcentaje_respuestas_correctas,
                p.created_at
            FROM `prueba_rendida_usuarios` p
            LEFT JOIN users u ON u.id = p.id_usuario
            LEFT JOIN respuestas_usuarios ru ON ru.id_prueba = p.id_prueba AND ru.id_usuario = p.id_usuario
            LEFT JOIN respuestas_pruebas rp ON rp.id_pregunta = ru.id_pregunta
            WHERE p.id = {$id_prueba_rendida_usuario}
            GROUP BY p.id, u.id
            ORDER BY p.created_at DESC;
        ");

        $item = $preguntas_prueba[0]; 
        $item->estado_aprobado = $item->porcentaje_respuestas_correctas > 80? true : false;
        
        return $item;
   }

    public function getResultadosPruebas()
    {
        $preguntas_prueba = DB::select("
            SELECT 
                p.id,
                u.name,
                (
                    SELECT COUNT(id) 
                    FROM preguntas 
                    WHERE preguntas.id_prueba = p.id_prueba
                    AND preguntas.temario_id in (
                        SELECT temario_id
                        FROM users_temarios
                        WHERE users_temarios.user_id = u.id
                    )
                ) as total_preguntas,
                COUNT(rp.id_pregunta) AS total_respuestas,
                SUM(rp.id_alternativa_correcta = ru.id_alternativa) AS respuestas_correctas,
                SUM(rp.id_alternativa_correcta != ru.id_alternativa) AS respuestas_incorrectas,
                (SUM(rp.id_alternativa_correcta = ru.id_alternativa) / COUNT(rp.id_pregunta)) * 100 AS porcentaje_respuestas_correctas,
                p.created_at
            FROM `prueba_rendida_usuarios` p
            LEFT JOIN users u ON u.id = p.id_usuario
            LEFT JOIN respuestas_usuarios ru ON ru.id_prueba = p.id_prueba AND ru.id_usuario = p.id_usuario
            LEFT JOIN respuestas_pruebas rp ON rp.id_pregunta = ru.id_pregunta
            WHERE u.presento = 1
            GROUP BY p.id, u.id
            ORDER BY p.created_at DESC;
        ");
        $preguntas_prueba = collect($preguntas_prueba)->map(function($item){
            $item->estado_aprobado = $item->porcentaje_respuestas_correctas > 80? true : false;
            return $item;
        });

        return Datatables::of($preguntas_prueba)
            ->addIndexColumn()
            ->make(true);
    }


    public function getListPreguntasPrueba($id)
    {
        $user = request()->user();
        $preguntas_prueba = Pregunta::where('id_prueba',$id)->when($user, function($query) use ($user){
            $query->whereIn("temario_id", $user->temarios->pluck("id"));
        })->get();
        $lista_preguntas=[];

        $respuesta_user = RespuestasUsuario::get()->pluck('id_alternativa'); 
        $respuestas =  RespuestasPrueba::whereIn('id_alternativa_correcta', $respuesta_user)->get();
        foreach ($preguntas_prueba as $key => $pregunta){

            $id_pregunta = $pregunta['id'];
            $temp_pregunta_prueba['id_pregunta'] = $pregunta['id'];
            $temp_pregunta_prueba['numero_pregunta_prueba'] = $key + 1;//$pregunta['numero_pregunta_prueba'];
            $temp_pregunta_prueba['enunciado_pregunta'] = $pregunta['enunciado_pregunta'];
            
			//prueba correcta
			$respUser = RespuestasUsuario::where('id_usuario', Auth::user()->id)
										 ->where('id_pregunta', $pregunta['id'])->first();
			$correct = false;
			if($respUser) {
				$respPrueba = RespuestasPrueba::where('id_pregunta', $pregunta['id'])->first();
				if ($respPrueba) {
					if($respUser->id_alternativa == $respPrueba->id_alternativa_correcta) {
						$correct = true;
					}
				} else {
					$correct = false;
				}
			}
			
            $temp_pregunta_prueba['correcta'] =  $correct; //$respuestas->contains($pregunta['id']);
            //Chequeamos si estan correctas las preguntas
            $alternativas = Alternativa::where('id_pregunta', $id_pregunta)->get();
            
            $lista_alternativas=[];
            foreach ($alternativas as $alternativa){
                $temp_alternativa['id_alternativa'] = $alternativa['id'];                
                $temp_alternativa['descripcion_alternativa'] = $alternativa['descripcion_alternativa'];                
                $lista_alternativas[]=$temp_alternativa;
            }
            $temp_pregunta_prueba['alternativas_pregunta'] = $lista_alternativas;
            $lista_preguntas[] = $temp_pregunta_prueba;

        }

        return response()->json($lista_preguntas);
    }

    public function storeRespuesta($id)
    {
        if (auth()->user()->presento == true) {
            return response()->json(['message' => 'Ya presento la prueba no puedes volver a presentarla'], 403);
        } else {
            $alternativa = Alternativa::where('id', $id)->get()->first();
            $pregunta = Pregunta::where('id', $alternativa['id_pregunta'])->get()->first();
            $prueba= Prueba::where('id', $pregunta['id_prueba'] )->get()->first();

            $respuesta_existe = RespuestasUsuario::where('id_pregunta', $alternativa['id_pregunta'])->where('id_usuario',Auth::user()->id)->get()->first();

            if($respuesta_existe){
                $respuesta_existente = RespuestasUsuario::where('id',$respuesta_existe['id'])->get()->first();
                $respuesta_existente->id_alternativa = $id;
                $respuesta_existente->save();

                return response()->json($respuesta_existente->fresh(), 201);
            }else{

                RespuestasUsuario::create([
                    'id_prueba' => $prueba['id'],
                    'id_usuario' => Auth::user()->id,
                    'id_pregunta' => $alternativa['id_pregunta'],
                    'id_alternativa' => $id
                ]);
                return response()->json([], 201);
            } 
        }    
    }

    public function startPrueba($id){
        $prueba = Prueba::where('id', $id)->get()->first();

        PruebaRendidaUsuario::create([
            'id_usuario' => Auth::user()->id,
            'id_prueba'  => $prueba['id'],
            'presento'   => 0,
            'start_at'   => now()
        ]);

        return response()->json(["message" => "Prueba Iniciada"], 201);
    }

    public function pruebaTime($id){
        $prueba = Prueba::where('id', $id)->get()->first();

        $prueba_rendida = PruebaRendidaUsuario::where([
            'id_usuario' => Auth::user()->id,
            'id_prueba'  => $prueba['id'],
        ])->first();

        if($prueba_rendida){
            $start_at = \Carbon\Carbon::parse($prueba_rendida->start_at);
            $seconds_left = $start_at->diffInSeconds(now());
            return response()->json([
                "time" => $seconds_left,
                "start_status" => true
            ], 200);
        }
        return response()->json([
            "start_status" => false,
            "time" => 0
        ], 200);
    }

    public function storePruebaRendida($id)
    {
        if (auth()->user()->presento == true) {
            return response()->json(['message' => 'Ya presento la prueba no puedes volver a presentarla'], 403);
        } else {
            $prueba = Prueba::where('id', $id)->get()->first();
            
            PruebaRendidaUsuario::updateOrCreate([
                'id_usuario' => Auth::user()->id,
                'id_prueba'  => $prueba['id']
            ], [
                'id_usuario' => Auth::user()->id,
                'id_prueba'  => $prueba['id'],
                'end_at'     => now()
            ]);

            $user = request()->user();
            $user->presento = 1;
            $user->save();

            return response()->json(['message' => "Prueba terminada"], 200);
        }
           
    }

}
