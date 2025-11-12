<?php

namespace App\Http\Requests\WebAuthn;

use Laragear\WebAuthn\Contracts\WebAuthnAuthenticatable as WebAuthnUser;
use Laragear\WebAuthn\Http\Requests\AttestationRequest;

class AttestationOptionsRequest extends AttestationRequest
{
    public function authorize(WebAuthnUser $user = null): bool
    {
        return true; // evita 403
    }
}
