<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    protected $table = "grupos";

    protected $fillable = [
        "nombre",
        "curso",
        "cliente",
        "tutor",
        "fecha",
        "hora"
    ];

    public function temarios_grupos(){
        return $this->belongsToMany(Temarios::class, "grupos_temarios", "grupo_id", "temario_id");
    }
}
