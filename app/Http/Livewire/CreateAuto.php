<?php

namespace App\Http\Livewire;

use App\Models\Auto;
use Livewire\{Component, WithFileUploads};

class CreateAuto extends Component
{
    use WithFileUploads;
    
    public $isOpen=false;
    public $marca=1, $modelo, $kms;
    public $foto;

    protected $rules=[
        'marca'=>['required'],
        'modelo'=>['required', 'string', 'min:2'],
        'kms'=>['required', 'integer', 'min:100', 'max:99999'],
        'foto'=>['nullable', 'image' , 'max:1024']
    ];

    public function render()
    {
        $marcas=['Audi', 'Fiat', 'Jeep', 'Peugeot', 'Opel', 'Renault', 'Seat', 'Toyota'];
        return view('livewire.create-auto', compact('marcas'));
    }

    public function guardar(){
        //dd($this->marca);
        $this->validate();
        $imagen=($this->foto) ? $this->foto->store('autos') : 'noimage.jpg';
        Auto::create([
            'marca'=>$this->marca,
            'modelo'=>ucwords($this->modelo),
            'foto'=>$imagen,
            'kms'=>$this->kms,
            'reservado'=>1
        ]);
        $this->emitTo('show-autos', 'render');
        $this->reset(['isOpen', 'foto', 'kms', 'marca', 'modelo']);
        $this->emit('info', "Coche guardado.");

        //
    }
}
