<?php

namespace App\Livewire\Vacantes\Components;

use App\Models\Vacante;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarVacantes extends Component
{
    use WithPagination;

    #[On('eliminarVacante')]
    public function eliminarVacante(Vacante $vacante)
    {
        $vacante->delete();
    }

    public function render()
    {
        $vacantes = Vacante::where('user_id', auth()->user()->id)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        return view('livewire.vacantes.components.mostrar-vacantes', [
            'vacantes' => $vacantes
        ]);
    }
}
