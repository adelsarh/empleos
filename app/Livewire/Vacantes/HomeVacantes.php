<?php

namespace App\Livewire\Vacantes;

use App\Models\Vacante;
use Livewire\Component;


class HomeVacantes extends Component
{
    public $termino;
    public $salario;
    public $categoria;

    protected $listeners = ['terminosBusqueda' => 'busqueda'];

    public function busqueda($termino, $salario, $categoria)
    {
        $this->termino = $termino;
        $this->salario = $salario;
        $this->categoria = $categoria;

    }

    public function render()
    {
       // $vacantes = Vacante::all();
        $vacantes = Vacante::when($this->termino, function($query){
            $query->where('titulo', 'LIKE', '%'.$this->termino.'%');
       })
       ->when($this->salario, function($query){
            $query->where('salario_id', $this->salario);
       })
       ->when($this->categoria, function($query){
            $query->where('categoria_id', $this->categoria);
       })->get();

        return view('livewire.vacantes.home-vacantes',
            [
                "vacantes" => $vacantes
            ]);
    }
}
