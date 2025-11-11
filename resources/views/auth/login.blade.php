<x-guest-layout>
    <style>
        /* ==== ESTILOS PERSONALIZADOS ==== */
        :root {
            --azul-oscuro: #0a1f44;
            --azul-medio: #153e75;
            --azul-claro: #2b6cb0;
            --blanco: #ffffff;
            --gris-claro: #f2f4f8;
            --gris-texto: #a0aec0;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--azul-oscuro);
            color: var(--blanco);
            min-height: 100vh;
            display: flex;
            align-items: flex-start; /* Cambiado de center → flex-start para subir contenido */
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 1rem; /* antes 2rem */
            margin-top: 1rem; /* reduce espacio arriba */
            margin-bottom: 1rem; /* reduce espacio abajo */
        }

        .card {
            background-color: var(--blanco);
            border-radius: 1.25rem;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px; /* Más ancho en pantallas grandes */
            margin: 0 auto;
        }

        .logo {
            text-align: center;
            margin-bottom: 1rem;
        }

        .logo img {
            height: 200px;
            width: auto;
            display: block;
            margin: 0 auto;
        }

        h1 {
            font-size: 1.5rem;
            color: var(--blanco);
            text-align: center;
            margin-top: 0;
            font-weight: 600;
        }

        p.subtitle {
            text-align: center;
            color: var(--gris-texto);
            font-size: 0.9rem;
            margin-bottom: 1.2rem;
        }

        label {
            font-size: 0.9rem;
            color: var(--azul-oscuro);
            font-weight: 500;
            display: block;
            margin-bottom: 0.3rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            font-size: 0.95rem;
            color: #111827;
            background-color: #f9fafb;
            transition: border 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--azul-claro);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
            color: var(--azul-oscuro);
            font-size: 0.9rem;
        }

        .btn {
            display: block;
            width: 100%;
            text-align: center;
            padding: 0.9rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-primary {
            background-color: var(--azul-claro);
            color: var(--blanco);
        }

        .btn-primary:hover {
            background-color: var(--azul-medio);
        }

        .btn-outline {
            background-color: var(--blanco);
            color: var(--azul-oscuro);
            border: 1px solid #cbd5e0;
        }

        .btn-outline:hover {
            background-color: #edf2f7;
        }

        .footer {
            text-align: center;
            color: var(--gris-texto);
            font-size: 0.8rem;
            margin-top: 1rem;
        }

        /* MOBILE OPTIMIZACIÓN */
        @media (max-width: 480px) {
            .card {
                padding: 1.3rem;
            }
            h1 {
                font-size: 1.2rem;
            }
            .btn {
                font-size: 0.95rem;
            }
            .logo img {
                height: 220px;
            }
        }
    </style>

    <div class="login-container">
        {{-- LOGO --}}
        <div class="logo">
            <img src="{{ asset('images/biolockpng.png') }}" alt="BioLock">
            <h1>Bienvenido a BioLock</h1>
            <p class="subtitle">Accede para controlar tu llavín inteligente</p>
        </div>

        {{-- CARD / FORMULARIO --}}
        <div class="card">
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- EMAIL --}}
                <div>
                    <label for="email">Correo electrónico</label>
                    <input id="email" type="email" name="email" :value="old('email')" required
                           autofocus autocomplete="username" placeholder="tucorreo@ejemplo.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- PASSWORD --}}
                <div style="margin-top: 1rem;">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- RECORDAR --}}
                <label for="remember_me" class="remember">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>Recordarme</span>
                </label>

                {{-- BOTONES --}}
                <div style="margin-top: 1.3rem;">
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline" style="margin-top: 0.7rem;">
                            Crear cuenta
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
