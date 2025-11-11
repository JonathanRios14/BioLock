<?php

return [
    'host'      => env('MQTT_HOST', '127.0.0.1'),
    'port'      => (int) env('MQTT_PORT', 1883),
    'use_tls'   => filter_var(env('MQTT_TLS', false), FILTER_VALIDATE_BOOL),
    'username'  => env('MQTT_USERNAME', null),
    'password'  => env('MQTT_PASSWORD', null),
    'device_id' => env('MQTT_DEVICE_ID', 'llavin-esp32-01'),
    'topic_cmd' => env('MQTT_TOPIC_CMD', 'devices/llavin-esp32-01/cmd'),
    'topic_evt' => env('MQTT_TOPIC_EVT', 'devices/llavin-esp32-01/evt'),
];
