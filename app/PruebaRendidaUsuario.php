<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PruebaRendidaUsuario extends Model
{
    protected $fillable=[
        'id',
        'id_usuario', 
        'id_prueba',
        'start_at',
        'end_at'
    ];

    public static function obtenerResultadosUsuario($id_encuesta)
    {
        $prueba_rendida = PruebaRendidaUsuario::find($id_encuesta);

        if(is_null($prueba_rendida)){
            return null;
        }
        $respuestas_usuarios = RespuestasUsuario::where(["id_usuario" => $prueba_rendida->id_usuario, "id_prueba" => $prueba_rendida->id_prueba])->get();

        $respuestas_usuarios = $respuestas_usuarios->load(["pregunta.temario", "respuesta_correcta", "respuesta_usuario"])->toArray();

        $respuestas_usuarios = collect($respuestas_usuarios)->sortBy("pregunta.temario_id")->toArray();

        return $respuestas_usuarios;
    }

    // =============================================================
    // Relations
    // =============================================================

    public function user(){
        return $this->belongsTo(User::class, "id_usuario")->withTrashed();
    }
    
}
