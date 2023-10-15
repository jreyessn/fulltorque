<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupos_temarios extends Model
{
    
    protected $fillable = [
        "grupo_id",
        "temario_id"
    ];

    protected $with = "temario";

    public function temario() {
        return $this->belongsTo(Temarios::class, "temario_id");
    }
}
