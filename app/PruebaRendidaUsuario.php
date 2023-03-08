<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PruebaRendidaUsuario extends Model
{
    protected $fillable=[
        'id',
        'id_usuario', 
        'id_prueba'
    ];

    public static function obtenerResultadosUsuario($id_encuesta)
    {
        $prueba_rendida = PruebaRendidaUsuario::find($id_encuesta);

        if(is_null($prueba_rendida)){
            return null;
        }

        return $prueba_rendida->respuestas_usuarios->load(["pregunta", "respuesta_correcta", "respuesta_usuario"])->toArray();
    }

    // =============================================================
    // Relations
    // =============================================================

    public function user(){
        return $this->belongsTo(User::class, "id_usuario");
    }

    public function respuestas_usuarios(){
        return $this->hasMany(RespuestasUsuario::class, "id_usuario")->where(["id_usuario" => $this->id_usuario, "id_prueba" => $this->id_prueba]);
    }
    
}
