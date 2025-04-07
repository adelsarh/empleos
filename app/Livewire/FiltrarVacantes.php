<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use Livewire\Component;

class FiltrarVacantes extends Component
{

    public $termino;
    public $salario; 
    public $categoria;


    public function leerDatosFormulario()
    {
        $this->dispatch('terminosBusqueda', $this->termino, $this->salario, $this->categoria);
    }

    public function render()
    {
        $salarios = Salario::select('id', 'salario')->get();
        $categorias = Categoria::select('id', 'categoria')->get();
        return view(
            'livewire.filtrar-vacantes',
            [
                'salarios' => $salarios,
                'categorias' => $categorias
            ]
        );
    }
}
