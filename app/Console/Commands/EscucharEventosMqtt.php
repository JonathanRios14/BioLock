<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EventoDispositivo;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class EscucharEventosMqtt extends Command
{
    protected $signature = 'mqtt:escuchar-eventos';
    protected $description = 'Se suscribe al topic de eventos del dispositivo y guarda en la base de datos.';

    public function handle(): int
    {
        $cfg = config('mqtt');

        $settings = (new ConnectionSettings)
            ->setUsername($cfg['username'])
            ->setPassword($cfg['password'])
            ->setUseTls($cfg['use_tls']);

        $clienteId = 'laravel-sub-' . uniqid();
        $mqtt = new MqttClient($cfg['host'], $cfg['port'], $clienteId);

        $mqtt->connect($settings, true);

        $topico = $cfg['topic_evt']; // p.ej. devices/llavin-esp32-01/evt
        $this->info("✅ Suscrito a: {$topico}");

        $mqtt->subscribe($topico, function (string $t, string $mensaje) {
            $evento = $this->extraerNombreEvento($mensaje) ?? 'evento_dispositivo';

            EventoDispositivo::create([
                'evento' => $evento,
                'topico' => $t,
                // guardamos JSON tanto como string como array (cast en el modelo)
                'carga'  => json_decode($mensaje, true) ?? ['raw' => $mensaje],
            ]);

            $this->line("📩 Guardado evento: {$evento}");
        }, 0);

        // Bucle infinito del cliente
        $mqtt->loop(true);

        return self::SUCCESS;
    }

    private function extraerNombreEvento(string $json): ?string
    {
        try {
            $data = json_decode($json, true);
            return $data['evt'] ?? null;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
