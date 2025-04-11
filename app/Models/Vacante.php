<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;
    protected $casts = ['ultimo_dia' => 'date'];

    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'departamento_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function salario(){
        return $this->belongsTo(Salario::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function candidatos()
    {
        return $this->hasMany(Candidato::class)->orderBy('created_at', 'DESC');
    }

    public function reclutador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopeDisponibles($query)
    {
        return $query->where('ultimo_dia', '>=', now());
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
}
