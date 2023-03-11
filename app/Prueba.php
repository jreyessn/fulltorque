<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    protected $fillable=[
        'id',
        'id_encabezado_prueba', 
        'id_tipo_prueba', 
        'id_estado_prueba'
    ];

    protected $with = [
        "encabezado_prueba"
    ];

    public function encabezado_prueba() 
    {
        return $this->hasOne(EncabezadoPrueba::class, "id", "id_encabezado_prueba");
    }
}

