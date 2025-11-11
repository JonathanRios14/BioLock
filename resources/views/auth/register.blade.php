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
            align-items: center;
            justify-content: center;
        }

        .register-container {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }

        .card {
            background-color: var(--blanco);
            border-radius: 1.25rem;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo img {
            height: 200px;
            width: auto;
            display: block;
            margin: 0 auto;
        }

        h1 {
            font-size: 1.6rem;
            color: var(--blanco);
            text-align: center;
            margin-top: 1rem;
            font-weight: 600;
        }

        p.subtitle {
            text-align: center;
            color: var(--gris-texto);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        label {
            font-size: 0.9rem;
            color: var(--azul-oscuro);
            font-weight: 500;
            display: block;
            margin-bottom: 0.3rem;
        }

        input[type="text"],
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
            margin-top: 1.5rem;
        }

        .link {
            font-size: 0.85rem;
            color: var(--azul-claro);
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        /* MOBILE OPTIMIZACIÓN */
        @media (max-width: 480px) {
            .card {
                padding: 2rem;
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

    <div class="register-container">
        {{-- LOGO --}}
        <div class="logo">
            <img src="{{ asset('images/biolockpng.png') }}" alt="BioLock">
            <h1>Crear cuenta</h1>
            <p class="subtitle">Regístrate para comenzar a usar tu llavín inteligente</p>
        </div>

        {{-- CARD / FORMULARIO --}}
        <div class="card">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- NOMBRE --}}
                <div>
                    <label for="name">Nombre completo</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Tu nombre">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- EMAIL --}}
                <div style="margin-top: 1rem;">
                    <label for="email">Correo electrónico</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="tucorreo@ejemplo.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- PASSWORD --}}
                <div style="margin-top: 1rem;">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- CONFIRMAR PASSWORD --}}
                <div style="margin-top: 1rem;">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                {{-- BOTONES --}}
                <div style="margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary">Registrarse</button>

                    <a href="{{ route('login') }}" class="btn btn-outline" style="margin-top: 0.8rem;">
                        Ya tengo una cuenta
                    </a>
                </div>
            </form>
        </div>

    </div>
</x-guest-layout>
