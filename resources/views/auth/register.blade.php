<x-guest-layout>
    <style>
        /* ==== VARIABLES ==== */
        :root {
            --azul-oscuro: #0a1f44;
            --azul-medio: #153e75;
            --azul-claro: #2b6cb0;
            --blanco: #ffffff;
            --gris-claro: #f2f4f8;
            --gris-texto: #a0aec0;
        }

        /* ==== ESTILOS GENERALES ==== */
        * {
            box-sizing: border-box; /* ✅ evita que padding cause overflow */
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, var(--azul-oscuro) 0%, var(--azul-medio) 100%);
            color: var(--blanco);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        .register-container {
            width: 100%;
            max-width: 420px;
        }

        .card {
            background-color: var(--blanco);
            border-radius: 1.25rem;
            padding: 2rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            width: 100%;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        /* ==== LOGO ==== */
        .logo {
            text-align: center;
            margin-bottom: 1.2rem;
        }

        .logo img {
            height: 180px;
            max-width: 100%;
            display: block;
            margin: 0 auto;
        }

        h1 {
            font-size: 1.6rem;
            color: var(--blanco);
            font-weight: 600;
            margin-top: 0.5rem;
            text-align: center;
        }

        p.subtitle {
            text-align: center;
            color: var(--gris-texto);
            font-size: 0.95rem;
            margin-bottom: 1.3rem;
        }

        /* ==== FORM ==== */
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
            padding: 0.85rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            font-size: 0.95rem;
            color: #111827;
            background-color: #f9fafb;
            transition: border 0.3s, box-shadow 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--azul-claro);
            box-shadow: 0 0 0 3px rgba(43, 108, 176, 0.2);
        }

        /* ==== BOTONES ==== */
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
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.02);
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

        .link {
            font-size: 0.85rem;
            color: var(--azul-claro);
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        /* ==== RESPONSIVE ==== */
        @media (max-width: 768px) {
            body {
                padding: 1rem;
                align-items: flex-start;
            }

            .card {
                padding: 1.6rem;
            }

            h1 {
                font-size: 1.3rem;
            }

            .logo img {
                height: 160px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
            }

            .register-container {
                max-width: 100%;
                padding: 0 0.5rem;
            }

            .card {
                padding: 1.2rem;
                border-radius: 1rem;
            }

            h1 {
                font-size: 1.2rem;
            }

            p.subtitle {
                font-size: 0.85rem;
            }

            input,
            .btn {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 360px) {
            .card {
                padding: 1rem;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"] {
                font-size: 0.85rem;
                padding: 0.7rem 0.8rem;
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
