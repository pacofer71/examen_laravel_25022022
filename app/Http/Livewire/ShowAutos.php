<?php

namespace App\Http\Livewire;
use App\Models\Auto;
use Illuminate\Support\Facades\Storage;
use Livewire\{Component, WithPagination, WithFileUploads};

class ShowAutos extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $campo='id', $orden='desc', $isOpen=false;
    public Auto $auto;
    public $foto;
    
    protected $listeners=['render'];
    protected $rules=[
        'auto.marca'=>['required'],
        'auto.modelo'=>['required', 'string', 'min:2'],
        'auto.kms'=>['required', 'integer', 'min:100', 'max:99999'],
        'auto.reservado'=>['required'],
        'foto'=>['nullable', 'image' , 'max:1024']
    ];


    public function mount(){
        $this->auto=new Auto;
    }
    public function render()
    {
        
        $marcas=['Audi', 'Fiat', 'Jeep', 'Peugeot', 'Opel', 'Renault', 'Seat', 'Toyota'];
        $autos=Auto::whereNull('user_id')->orderBy($this->campo, $this->orden)->paginate(4);
        return view('livewire.show-autos', compact('autos', 'marcas'));
    }
    public function ordenar(String $cadena){
        if($cadena==$this->campo){
            $this->orden=($this->orden=='desc')?'asc':'desc';
        }
        else{
            $this->campo=$cadena;
        }
    }
    public function borrar(Auto $auto){
        //borro la imagen si no es la imagen por defecto
        if(basename($auto->foto)!='noimage.jpg'){
         Storage::delete($auto->foto);   
        }
        $auto->delete();
        $this->emit('info', "Coche Borrado!!!");
    }

    public function edit(Auto $auto){
        $this->auto=$auto;
        $this->isOpen=true;

    }
    public function update(){
        if($this->foto){
            if(basename($this->auto->foto)!='noimage.jpg'){
                Storage::delete($this->auto->foto);
            }
            $imagen = $this->foto->store('autos');
            $this->auto->foto = $imagen;
        }
        
        $this->auto->update();
        $this->reset(['isOpen', 'foto']);
        $this->emit('info', 'Auto actualizado.');
    }
    public function vender(Auto $auto){
        $this->auto=$auto;
        //dd($this->auto);
        if($this->auto->reservado==2){
            $this->emit('info', 'El Coche está reservado, levante la reserva primero!!!');
            return;
        }
        $this->auto->user_id=auth()->user()->id;
        $this->auto->reservado=null;
        $this->auto->update();
        $this->emit('info', "El vendedor:".auth()->user()->email.", vendio el coche: ".$this->auto->marca. " ".$this->auto->modelo);
    }
    public function reservar(Auto $auto){
        $this->auto=$auto;
        $this->auto->reservado = ($this->auto->reservado==1) ? 2: 1 ;
        $this->auto->update();
        $this->emit('info', "Se ha cambiado la reserva del coche");
    }

}
