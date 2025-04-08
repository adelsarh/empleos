<?php

namespace App\Livewire\Transacciones\Components;

use App\Models\Transaccion;
use App\Models\User;
use App\Notifications\TransaccionExitosa;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarTransacciones extends Component
{
    use WithPagination;

    public $filtro = 'pendientes'; // 'pendientes' o 'aprobadas'
    public $porPagina = 10;

    #[On('confirmarTransaccion')]
    public function confirmarTransaccion(Transaccion $transaccion)
    {
        Transaccion::where('id', $transaccion->id)->update([
            'estado' => 'aprobado',
            'fecha_aprobacion' => now(),
            'aprobado_por' => auth()->user()->id
        ]);

        $user = $transaccion->user;
        $user->update([
            'ultimo_pago_valido' => now(),
            'creditos' => $user->creditos + $transaccion->plan->creditos,
        ]);

        $user->notify(New TransaccionExitosa($transaccion->id, $transaccion->fecha_aprobacion, $transaccion->user->creditos));
    }

    public function cambiarFiltro($nuevoFiltro)
    {
        $this->filtro = $nuevoFiltro;
        $this->resetPage(); // Reinicia la paginación al cambiar filtros
    }

    public function render()
    {
        $transacciones = Transaccion::with(['user', 'plan', 'aprobador'])
            ->when($this->filtro === 'pendientes', fn($q) => $q->where('estado', 'pendiente'))
            ->when($this->filtro === 'aprobadas', fn($q) => $q->where('estado', 'aprobado'))
            ->latest()
            ->paginate($this->porPagina);

        return view('livewire.transacciones.components.mostrar-transacciones', [
            'transacciones' => $transacciones,
            'contadores' => [
                'pendientes' => Transaccion::where('estado', 'pendiente')->count(),
                'aprobadas' => Transaccion::where('estado', 'aprobado')->count()
            ]
        ]);
    }
}
