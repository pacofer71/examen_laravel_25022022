<?php

use App\Http\Controllers\AutoController;
use App\Http\Livewire\ShowAutos;
use App\Http\Livewire\VerVentas;
use Illuminate\Support\Facades\Route;
use Psy\TabCompletion\AutoCompleter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AutoController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('ventasautor', [AutoController::class, 'ventasAutor'])->name('ventas.autor');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('autos', ShowAutos::class)->name('autos.index');
Route::middleware(['auth:sanctum', 'verified'])->get('ventas', VerVentas::class)->name('ventas.index');

Route::put('autos/{auto}', [AutoController::class, 'updateReserva'])->name('autos.reserva');

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('ventas-totales', [AutoController::class, 'verTotalPorVendedor'])->name('ventas.totales');