<?php

namespace App\Livewire\Vacantes\Components;

use Livewire\Component;

class MostrarVacante extends Component
{
    public $vacante;
    public function render()
    {
        return view('livewire.vacantes.components.mostrar-vacante');
    }
}
