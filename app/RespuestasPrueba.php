<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestasPrueba extends Model
{
    protected $fillable=[
        'id',
        'id_pregunta', 
        'id_alternativa_correcta'
    ];
}
