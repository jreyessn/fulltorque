<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Temarios extends Model
{
    use SoftDeletes;

    protected $table = "temarios";

    protected $fillable = [
        "name",
        "prueba_id"
    ];
}
