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
}
