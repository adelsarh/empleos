<?php

namespace App\Livewire\Vacantes\Components;

use App\Enums\UserRoles;
use App\Models\Categoria;
use App\Models\Departamento;
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
    public $departamento;
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
        'departamento' => 'nullable',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|mimes:jpg,png,jpeg|max:1024',
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
                'departamento_id' => $datos['departamento'],
                'empresa' => $datos['empresa'],
                'ultimo_dia' => $datos['ultimo_dia'],
                'descripcion' => $datos['descripcion'],
                'imagen' => $nombreImagen,
                'user_id' => auth()->user()->id
            ]);

            //si el usuario no es administrador, se le resta un credito
            auth()->user()->rol_id !== UserRoles::ADMINISTRADOR
                ? auth()->user()->decrement('creditos', 1)
                : null;

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
        $departamentos = Departamento::orderBy('nombre')->get();

        return view('livewire.vacantes.components.crear-vacante',
        [
            "salarios" => $salarios,
            "categorias" => $categorias,
            "departamentos" => $departamentos
        ]
        );
    }
}
