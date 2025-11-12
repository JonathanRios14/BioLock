<?php

namespace App\Http\Controllers\WebAuthn;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use App\Http\Requests\WebAuthn\AttestationOptionsRequest;
use App\Http\Requests\WebAuthn\AttestedStoreRequest;

use function response;

class WebAuthnRegisterController
{
    // Devuelve opciones de attestation (registro de passkey)
    public function options(AttestationOptionsRequest $request): Responsable
    {
        return $request
            ->fastRegistration() // opcional: quita si quieres atestación "completa"
            ->toCreate();
    }

    // Guarda la credencial creada
    public function store(AttestedStoreRequest $request): Response
    {
        $request->save();
        return response()->noContent(); // 204
    }
}
