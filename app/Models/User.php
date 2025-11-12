<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// ✅ contrato + trait correctos del paquete
use Laragear\WebAuthn\Contracts\WebAuthnAuthenticatable as WebAuthnContract;
use Laragear\WebAuthn\WebAuthnAuthentication;

class User extends Authenticatable implements WebAuthnContract
{
    use HasFactory, Notifiable, WebAuthnAuthentication; // 👈 ESTE trait, no otro

    protected $fillable = ['name','email','password'];

    protected $hidden = ['password','remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function dispositivo()
    {
        return $this->hasOne(Dispositivo::class);
    }
}
