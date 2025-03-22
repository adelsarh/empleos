<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate; 


class PostularVacante extends Component
{
    use WithFileUploads;

    #[Validate('required|mimes:pdf|max:1024')]
    public $cv; 

    public function postularse()
    {
        $this->validate();

        //almacenar el CV
        $this->cv->store('cv');


        //crear la postulacion

        //crear notificacion


    }


    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
