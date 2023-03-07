<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
     protected $table = 'users'; // Nombre de la tabla en la base de datos
    protected $fillable = ['name', 'email', 'password'}
