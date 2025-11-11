<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    // Mostrar el panel de control
    public function index()
    {
        $dispositivo = null;

        // Verifica si hay usuario logueado
        if ($user = Auth::user()) {
            $dispositivo = $user->dispositivo; // Trae el dispositivo asociado (puede ser null)
        }

        // Siempre pasa la variable a la vista
        return view('dashboard', compact('dispositivo'));
    }



public function eventosJson()
    {
        return EventoDispositivo::latest()->limit(30)->get();
    }
}
