<?php

namespace App\Livewire\Vacantes;

use App\Models\Vacante;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class HomeVacantes extends Component
{
    use WithPagination;

    public $termino = '';
    public $salario = '';
    public $categoria = '';

    protected $listeners = ['terminosBusqueda' => 'busqueda'];

    public function busqueda($termino, $salario, $categoria)
    {
        $this->termino = $termino;
        $this->salario = $salario;
        $this->categoria = $categoria;
        $this->resetPage(); // Resetear paginación al aplicar nuevos filtros
    }

    #[On('limpiarFiltros')]
    public function limpiarFiltros()
    {
        $this->reset(['termino', 'salario', 'categoria']); // Método más limpio
        $this->resetPage(); // Importante: resetear también la paginación
    }

    public function updated($property)
    {
        // Resetear paginación cuando cambia cualquier filtro
        if (in_array($property, ['termino', 'salario', 'categoria'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $vacantes = Vacante::disponibles()
            ->when($this->termino, function($query) {
                $query->where('titulo', 'LIKE', '%' . $this->termino . '%');
            })
            ->when($this->salario, function($query) {
                $query->where('salario_id', $this->salario);
            })
            ->when($this->categoria, function($query) {
                $query->where('categoria_id', $this->categoria);
            })
            ->latest()
            ->paginate(20);

        return view('livewire.vacantes.home-vacantes', [
            "vacantes" => $vacantes
        ]);
    }
}
