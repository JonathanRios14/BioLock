<?php

return [

    'relying_party' => [
        'name' => env('WEBAUTHN_NAME', config('app.name')),
        'id'   => env('WEBAUTHN_ID', parse_url(config('app.url'), PHP_URL_HOST)),
    ],

    // Siempre array (soporta coma-separado en .env)
    'origins' => array_values(array_filter(array_map('trim', explode(
        ',', env('WEBAUTHN_ORIGINS', config('app.url'))
    )))),

    'challenge' => [
        'bytes'   => 16,
        'timeout' => 60,
        'key'     => '_webauthn',
    ],
];
