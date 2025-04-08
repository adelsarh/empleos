<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'planes';
    public function transaccion()
    {
        return $this->hasMany(Transaccion::class);
    }

}
