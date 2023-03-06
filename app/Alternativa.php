<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alternativa extends Model
{

    protected $fillable = [
        'id',
        'id_pregunta', 
        'descripcion_alternativa'
    ];
}
