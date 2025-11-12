<x-guest-layout>
    <style>
        :root {
            --azul-oscuro: #0a1f44;
            --azul-medio: #153e75;
            --azul-claro: #2b6cb0;
            --blanco: #ffffff;
            --gris-claro: #f2f4f8;
            --gris-texto: #a0aec0;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, var(--azul-oscuro) 0%, var(--azul-medio) 100%);
            color: var(--blanco);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 1rem;
        }

        .login-container {
            width: 100%;
            max-width: 480px; /* aumentamos para pantallas grandes */
        }

        .card {
            background-color: var(--blanco);
            border-radius: 1.5rem;
            padding: 2.2rem; /* más espacio interno */
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.25);
            width: 100%;
        }

        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo img {
            height: 200px; /* más grande */
            max-width: 100%;
            display: block;
            margin: 0 auto;
        }

        h1 {
            font-size: 1.8rem; /* más grande */
            color: var(--blanco);
            font-weight: 600;
            margin: 0.5rem 0;
            text-align: center;
        }

        p.subtitle {
            text-align: center;
            color: var(--gris-texto);
            font-size: 1rem; /* más legible */
            margin-bottom: 1.5rem;
        }

        label {
            font-size: 1rem; /* más grande */
            color: var(--azul-oscuro);
            font-weight: 500;
            display: block;
            margin-bottom: 0.4rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.85rem;
            font-size: 1rem;
            color: #111827;
            background-color: #f9fafb;
        }

        input:focus {
            outline: none;
            border-color: var(--azul-claro);
            box-shadow: 0 0 0 3px rgba(43, 108, 176, 0.2);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.7rem;
            color: var(--azul-oscuro);
            font-size: 1rem; /* más grande */
        }

        .btn {
            display: block;
            width: 100%;
            text-align: center;
            padding: 1rem; /* más grande */
            border-radius: 0.85rem;
            font-weight: 600;
            font-size: 1.05rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary { background-color: var(--azul-claro); color: var(--blanco); }
        .btn-primary:hover { background-color: var(--azul-medio); }

        .btn-outline { background-color: var(--blanco); color: var(--azul-oscuro); border: 1px solid #cbd5e0; }
        .btn-outline:hover { background-color: #edf2f7; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .login-container { max-width: 420px; }
            .card { padding: 2rem; }
            .logo img { height: 180px; }
            h1 { font-size: 1.6rem; }
            p.subtitle { font-size: 0.95rem; }
            input, .btn, label, .remember { font-size: 0.95rem; padding: 0.9rem; }
        }

        @media (max-width: 480px) {
            .login-container { max-width: 100%; padding: 0 0.5rem; }
            .card { padding: 1.6rem; border-radius: 1.25rem; }
            .logo img { height: 160px; }
            h1 { font-size: 1.4rem; }
            p.subtitle { font-size: 0.9rem; }
            input, .btn, label, .remember { font-size: 0.9rem; padding: 0.85rem; }
        }

        @media (max-width: 360px) {
            .card { padding: 1.3rem; }
            .logo img { height: 140px; }
            h1 { font-size: 1.3rem; }
            p.subtitle { font-size: 0.85rem; }
            input, .btn, label, .remember { font-size: 0.85rem; padding: 0.75rem; }
        }
    </style>

    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('images/biolockpng.png') }}" alt="BioLock">
            <h1>Bienvenido a BioLock</h1>
            <p class="subtitle">Accede para controlar tu llavín inteligente</p>
        </div>

        <div class="card">
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email">Correo electrónico</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="tucorreo@ejemplo.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div style="margin-top: 1rem;">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <label for="remember_me" class="remember">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>Recordarme</span>
                </label>

                <div style="margin-top: 1.3rem;">
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline" style="margin-top: 0.7rem;">Crear cuenta</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
