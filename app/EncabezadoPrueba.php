<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncabezadoPrueba extends Model
{
    protected $fillable=[
        'id',
        'id_prueba',
        'titulo_prueba', 
        'descripcion_prueba'
    ];

    public function prueba() 
    {
        return $this->belongsTo(Prueba::class);
    }
    
}
