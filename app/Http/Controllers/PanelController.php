<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventoDispositivo;

class PanelController extends Controller
{
    public function index()
    {
        $eventos = EventoDispositivo::latest()->limit(30)->get();
        return view('dashboard', compact('eventos'));
    }

    public function eventosJson()
    {
        return EventoDispositivo::latest()->limit(30)->get();
    }
}
