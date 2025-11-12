<?php

namespace App\Http\Controllers\WebAuthn;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use App\Http\Requests\WebAuthn\AssertionOptionsRequest;
use App\Http\Requests\WebAuthn\AssertedLoginRequest;

use function response;

class WebAuthnLoginController
{
    // Devuelve opciones de assertion (login con passkey)
    public function options(AssertionOptionsRequest $request): Responsable
    {
        // Puedes permitir "hint" por email si lo deseas:
        $data = $request->validate(['email' => 'sometimes|email|string']);

        return $request->toVerify($data);
    }

    // Valida la assertion y realiza el login
    public function store(AssertedLoginRequest $request): Response
    {
        return response()->noContent($request->login() ? 204 : 422);
    }
}
