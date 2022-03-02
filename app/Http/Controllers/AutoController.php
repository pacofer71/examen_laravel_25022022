<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autos = Auto::whereNull('user_id')->orderBy('id', 'desc')->paginate(5);
        return view('welcome', compact('autos'));
    }

    public function verTotalPorVendedor(){
        
        $totales=User::select('name', 'email',  DB::raw('count(name) as total'))->leftJoin('autos', 'autos.user_id', '=', 'users.id')->groupBy('name', 'email')->orderBy('total', 'desc')->get();
        return view('ventas.totales', compact('totales'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function updateReserva(Request $request, Auto $auto)
    {
        $auto->reservado=($auto->reservado==1) ? 2 : 1;
        $auto->update();
        $cadena=($auto->reservado==1) ? "Reserva Quitada!!": "Coche reservado!!";
        return redirect('/')->with('info', $cadena);
    }

   
}
