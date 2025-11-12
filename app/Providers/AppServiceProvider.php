<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Forzar HTTPS con ngrok
        if (str_contains(config('app.url'), 'ngrok')) {
            URL::forceScheme('https');
            $_SERVER['HTTPS'] = 'on';
        }

        // 🔓 Autoriza TODAS las abilities en entorno local (solo desarrollo).
        Gate::before(function ($user = null, $ability = null) {
            if (app()->environment('local')) {
                return true;
            }
            return null;
        });

        // (Opcional) Log para ver qué ability pide el paquete
        Gate::after(function ($user = null, $ability = null, $result = null, $arguments = []) {
            \Log::debug('Gate check', compact('ability', 'result', 'arguments'));
        });
    }
}

