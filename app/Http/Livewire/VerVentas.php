<?php

namespace App\Http\Livewire;

use App\Models\Auto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\{Component, WithPagination};


class VerVentas extends Component
{
    use WithPagination;
    public $campo='updated_at', $orden='desc';
    public $search="";

    public function render()
    {
        
        $userId = User::where('email', 'like', "%{$this->search}%")->pluck('id')->toArray();;
        
        $autos=Auto::whereNotNull('user_id')
        ->orderBy($this->campo, $this->orden)
        ->whereIn('user_id', $userId)->paginate(5);
        return view('livewire.ver-ventas', compact('autos'));
    }
    public function formatFecha($date){
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
    }
    public function ordenar($campo){
        if($this->campo=$campo){
            $this->orden=($this->orden=='asc') ? 'desc' :'asc';
        }else{
            $this->campo=$campo;
        }
        
    }
    public function borrar(Auto $auto){
        //borro la imagen si no es la imagen por defecto
        if(basename($auto->foto)!='noimage.jpg'){
         Storage::delete($auto->foto);   
        }
        $auto->delete();
        $this->emit('info', "Venta Borrada!!!");
    }
}
