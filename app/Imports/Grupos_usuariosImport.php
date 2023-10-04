<?php

namespace App\Imports;

use App\Grupos_usuarios;
use Maatwebsite\Excel\Concerns\ToModel;

class Grupos_usuariosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Grupos_usuarios([
            //
        ]);
    }
}
