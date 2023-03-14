<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $fillable=[
        'id',
        'numero_pregunta_prueba',
        'id_prueba',
        'temario_id',
        'id_tipo_pregunta', 
        'id_respuesta_pregunta', 
        'enunciado_pregunta'
    ];

    public function temario(){
        return $this->belongsTo(Temarios::class, "temario_id");
    }

}
