<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupos_usuarios extends Model
{
    
    protected $fillable = [
        "users_id",
        "grupo_id"
    ];

    public function user() {
        return $this->belongsTo(User::class, "users_id");
    }

}
