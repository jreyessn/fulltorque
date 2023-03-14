<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestasUsuario extends Model
{
    protected $fillable=[
        'id',
        'id_prueba',
        'id_usuario',
        'id_pregunta', 
        'id_alternativa'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'id_usuario');
    }

    public function pregunta(){
        return $this->belongsTo(Pregunta::class, "id_pregunta")->orderBy("temario_id", "asc");
    }
    
    public function respuesta_correcta(){
        return $this->hasOneThrough(Alternativa::class, RespuestasPrueba::class, "id_pregunta", "id", "id_pregunta", "id_alternativa_correcta");
    }
        
    public function respuesta_usuario(){
        return $this->hasOne(Alternativa::class, "id", "id_alternativa");
    }
    
}
