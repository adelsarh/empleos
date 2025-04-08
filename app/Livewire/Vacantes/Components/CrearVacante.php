<?php

namespace App\Livewire\Vacantes\Components;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\User;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{

    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    use WithFileUploads;

    //validacion de los campos en el formulario
    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024',
    ];

    public function crearVacante(){
        $datos = $this->validate();

        //almacenar la imagen
        $imagen = $this->imagen->store(path: 'vacantes');
        $nombreImagen = str_replace('vacantes/', '', $imagen);

        try {
            Vacante::create([
                'titulo' => $datos['titulo'],
                'salario_id' => $datos['salario'],
                'categoria_id' => $datos['categoria'],
                'empresa' => $datos['empresa'],
                'ultimo_dia' => $datos['ultimo_dia'],
                'descripcion' => $datos['descripcion'],
                'imagen' => $nombreImagen,
                'user_id' => auth()->user()->id
            ]);

            User::find(auth()->user()->id, 'id')->decrement('creditos', 1);

        }catch (\Illuminate\Database\QueryException $e) {
            session()->flash('error', 'Error al crear la vacante: ' . $e->getMessage());
            return;
        }

        session()->flash('success', 'La vacante se publicó correctamente.');

        return redirect()->route('vacantes.index');

    }


    public function render()
    {
        //consultar base de datos para salarios
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.vacantes.components.crear-vacante',
        [
            "salarios" => $salarios,
            "categorias" => $categorias
        ]
        );
    }
}
