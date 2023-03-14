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
        
        return $respuestas_usuarios->load(["pregunta", "respuesta_correcta", "respuesta_usuario"])->toArray();
    }

    // =============================================================
    // Relations
    // =============================================================

    public function user(){
        return $this->belongsTo(User::class, "id_usuario");
    }
    
}
