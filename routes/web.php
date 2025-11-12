<?php

use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthn\WebAuthnRegisterController as RegisterController;
use App\Http\Controllers\WebAuthn\WebAuthnLoginController as LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Todas estas rutas usan el middleware "web" (sesión, CSRF, cookies).
| Aun así, dejamos explícito "web" en los grupos de passkeys por claridad.
*/

// Página de inicio: envía al login de Breeze
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Dashboard (protegido)
Route::get('/dashboard', [PanelController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Perfil (protegido)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Panel y endpoints propios (protegidos)
Route::middleware('auth')->group(function () {
    Route::get('/panel', [PanelController::class, 'index'])->name('panel');
    Route::get('/eventos.json', [PanelController::class, 'eventosJson'])->name('panel.eventos');

    Route::get('/dispositivo/enlazar', [DispositivoController::class, 'showEnlazarForm'])->name('dispositivo.enlazar-form');
    Route::post('/dispositivo/enlazar', [DispositivoController::class, 'enlazar'])->name('dispositivo.enlazar');

    Route::post('/dispositivo/abrir', [DispositivoController::class, 'abrir'])->name('dispositivo.abrir');
    Route::post('/dispositivo/enrolar', [DispositivoController::class, 'enrolar'])->name('dispositivo.enrolar');
});

// ===== Passkeys: enrolamiento (requiere sesión) =====
Route::middleware(['web', 'auth'])->group(function () {
    // Vista para registrar la huella/FaceID (enrolamiento)
    Route::view('/passkeys/enroll', 'auth.enroll-passkey')->name('passkeys.enroll');

    // Opciones de registro (attestation) y almacenamiento
    Route::get('/passkeys/register/options', [RegisterController::class, 'options'])
        ->name('passkeys.register.options');

    Route::post('/passkeys/register', [RegisterController::class, 'store'])
        ->name('passkeys.register.store');
});

// ===== Passkeys: login (público, pero con "web" para sesión/CSRF) =====
Route::middleware(['web'])->group(function () {
    Route::get('/passkeys/login/options', [LoginController::class, 'options'])
        ->name('passkeys.login.options');

    Route::post('/passkeys/login', [LoginController::class, 'store'])
        ->name('passkeys.login.store');
});

// Rutas de Breeze (login/register/password, etc.)
require __DIR__ . '/auth.php';
