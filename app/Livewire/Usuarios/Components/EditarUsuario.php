<?php

namespace App\Livewire\Usuarios\Components;

use App\Models\User;
use Livewire\Component;

class EditarUsuario extends Component
{

    public $usuario_id;
    public $nombre;
    public $email;
    public $estado;

    public function mount(User $user)
    {
        $this->usuario_id = $user->id;
        $this->nombre = $user->name;
        $this->email = $user->email;
        $this->estado = $user->estado;
    }

    public function editarUsuario(){
        $this->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$this->usuario_id,
            'estado' => 'required|boolean',
        ]);

        User::where('id', $this->usuario_id)->update([
            'name' => $this->nombre,
            'email' => $this->email,
            'estado' => $this->estado,
        ]);

        session()->flash('message', 'Usuario actualizado correctamente.');

        return redirect()->route('user.index');
    }

    public function eliminar(){

    }
    public function render()
    {
        return view('livewire.usuarios.components.editar-usuario');
    }
}
