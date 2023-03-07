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
}
