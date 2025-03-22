<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'cv',
        'vacante_id', 
        'user_id'
    ];


}
