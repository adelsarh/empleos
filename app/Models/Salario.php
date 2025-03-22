<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salario extends Model
{
    //

    public function vacantes()
    {
        return $this->hasMany(Vacante::class);
    }
}
