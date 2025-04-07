<?php

namespace App\Livewire\Usuarios\Components;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class MostrarUsuarios extends Component
{
    public $usuarios;

    #[On('eliminarUsuario')]
    public function eliminarUsuario(User $user)
    {
        try {
            $user->delete();
            $this->dispatch('usuarioEliminado');
        } catch (\Exception $e) {
            $this->dispatch('errorAlEliminar', message: 'Error al eliminar el usuario');
        }
    }

    public function render()
    {
        $usuarios = $this->usuarios =  User::where('id', '!=', auth()->id())->get();
        return view('livewire.usuarios.components.mostrar-usuarios', compact('usuarios'));
    }
}
