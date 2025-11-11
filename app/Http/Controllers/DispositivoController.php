<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MqttPublisher;

class DispositivoController extends Controller
{
    public function abrir(Request $request, MqttPublisher $mqtt)
    {
        $this->autorizar($request);
        $mqtt->publish(config('mqtt.topic_cmd'), ['cmd' => 'open']);
        return back()->with('status', '🔓 Comando de apertura enviado.');
    }

    public function enrolar(Request $request, MqttPublisher $mqtt)
    {
        $this->autorizar($request);
        $data = $request->validate(['finger_id' => 'required|integer|min:1|max:127']);
        $mqtt->publish(config('mqtt.topic_cmd'), ['cmd' => 'enroll', 'id' => (int)$data['finger_id']]);
        return back()->with('status', '✍️ Enrolado iniciado. Coloca el dedo dos veces.');
    }

    private function autorizar(Request $request): void
    {
        if (!$request->user()) abort(403);
    }
}
