<?php

use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/panel', [PanelController::class, 'index'])->name('panel');
    Route::get('/eventos.json', [PanelController::class, 'eventosJson'])->name('panel.eventos');

    Route::post('/dispositivo/abrir',  [DispositivoController::class, 'abrir'])->name('dispositivo.abrir');
    Route::post('/dispositivo/enrolar',[DispositivoController::class, 'enrolar'])->name('dispositivo.enrolar');
});

require __DIR__.'/auth.php';
