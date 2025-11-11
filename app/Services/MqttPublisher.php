<?php

namespace App\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class MqttPublisher
{
    public function publish(string $topic, array $payload, int $qos = 0, bool $retain = false): void
    {
        // Cargar configuración desde config/mqtt.php
        $cfg = config('mqtt');

        // Configurar credenciales y TLS
        $settings = (new ConnectionSettings)
            ->setUsername($cfg['username'])
            ->setPassword($cfg['password'])
            ->setUseTls($cfg['use_tls']);

        // Generar un ID único para cada conexión
        $clientId = 'laravel-' . uniqid();

        // Crear cliente MQTT
        $mqtt = new MqttClient($cfg['host'], $cfg['port'], $clientId);

        // Conectar al broker
        $mqtt->connect($settings, true);

        // Enviar mensaje
        $mqtt->publish($topic, json_encode($payload, JSON_UNESCAPED_UNICODE), $qos, $retain);

        // Desconectar
        $mqtt->disconnect();
    }
}
