<?php

namespace App\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate; 


class PostularVacante extends Component
{
    use WithFileUploads;

    #[Validate('required|mimes:pdf|max:1024')]
    public $cv; 
    public $vacante;

    public function mount(Vacante $vacante)
    {
        
    }

    public function postularse()
    {
        $this->validate();

        //almacenar el CV
        $cv = $this->cv->store(path: 'cv');
        $cvRuta = str_replace('cv/', '', $cv);

        //crear la postulacion
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $cvRuta
        ]);

        //crear notificacion
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));


        session()->flash('message', 'Se envio correctamente tu postulación, ¡mucha suerte!');

        return redirect()->back();


    }


    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
