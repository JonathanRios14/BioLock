<?php

namespace App\Http\Requests\WebAuthn;

use Laragear\WebAuthn\Contracts\WebAuthnAuthenticatable as WebAuthnUser;
use Laragear\WebAuthn\Http\Requests\AssertedRequest;

class AssertedLoginRequest extends AssertedRequest
{
    public function authorize(WebAuthnUser $user = null): bool
    {
        return true; // evita 403
    }
}
