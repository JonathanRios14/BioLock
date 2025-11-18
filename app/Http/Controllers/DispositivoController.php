<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MqttPublisher;
use App\Models\Dispositivo; // <- Asegúrate de tener este modelo
use Illuminate\Support\Facades\Auth;

class DispositivoController extends Controller
{
    // Abrir cerradura
    public function abrir(Request $request, MqttPublisher $mqtt)
    {
        $this->autorizar($request);
        $mqtt->publish(config('mqtt.topic_cmd'), ['cmd' => 'open']);
        return back()->with('status', '🔓 Comando de apertura enviado.');
    }

    // Enrolar huella
    public function enrolar(Request $request, MqttPublisher $mqtt)
    {
        $this->autorizar($request);
        $mqtt->publish(config('mqtt.topic_cmd'), ['cmd' => 'enroll']);
        return back()->with('status', '✍️ Enrolado iniciado. Coloca el dedo dos veces.');
    }


    // Mostrar formulario de enlace de dispositivo
    public function showEnlazarForm(Request $request)
    {
        $this->autorizar($request);
        return view('dispositivo.enlazar');
    }

    // Procesar el enlace de código físico
    public function enlazar(Request $request)
    {
        $this->autorizar($request);

        $request->validate([
            'codigo' => 'required|string|exists:dispositivos,codigo_unico',
        ]);

        $dispositivo = Dispositivo::where('codigo_unico', $request->codigo)->first();

        if ($dispositivo->user_id) {
            return back()->withErrors(['codigo' => 'Este llavín ya está enlazado a otra cuenta']);
        }

        $dispositivo->user_id = Auth::id();
        $dispositivo->save();

        return redirect()->route('panel')->with('status', '¡Dispositivo enlazado correctamente!');
    }

    // Autorizar usuario
    private function autorizar(Request $request): void
    {
        if (!$request->user()) abort(403);
    }
}
