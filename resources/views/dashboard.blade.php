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

        * {
            box-sizing: border-box; /* evita overflow con padding */
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--azul-oscuro);
            color: var(--blanco);
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 1rem;
        }

        .panel-container {
            width: 100%;
            max-width: 420px;
        }

        .card {
            background-color: var(--blanco);
            color: var(--azul-oscuro);
            border-radius: 1.25rem;
            padding: 2rem;
            margin-bottom: 1rem;
            box-shadow: 0 6px 20px rgba(0,0,0,0.25);
            width: 100%;
            text-align: center;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .logo img {
            width: 220px;
            max-width: 100%;
            height: auto;
        }

        h1 {
            font-size: 1.5rem;
            margin: 0.5rem 0;
            font-weight: 600;
        }

        p {
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        input[type="number"] {
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid #cbd5e0;
            margin-top: 0.5rem;
            font-size: 1rem;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 0.9rem;
            margin-top: 1rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            text-align: center;
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

        /* ==== RESPONSIVE ==== */
        @media (max-width: 768px) {
            .card {
                padding: 1.6rem;
            }

            h1 {
                font-size: 1.3rem;
            }

            input[type="number"] {
                font-size: 0.95rem;
                padding: 0.8rem 0.9rem;
            }

            .btn {
                font-size: 0.95rem;
                padding: 0.85rem;
            }

            .logo img {
                width: 180px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
                align-items: flex-start;
            }

            .panel-container {
                max-width: 100%;
                padding: 0 0.5rem;
            }

            .card {
                padding: 1.3rem;
                border-radius: 1rem;
            }

            h1 {
                font-size: 1.2rem;
            }

            p {
                font-size: 0.85rem;
            }

            input[type="number"] {
                font-size: 0.9rem;
                padding: 0.7rem 0.8rem;
            }

            .btn {
                font-size: 0.9rem;
                padding: 0.8rem;
            }

            .logo img {
                width: 160px;
            }
        }

        @media (max-width: 360px) {
            .card {
                padding: 1rem;
            }

            input[type="number"] {
                font-size: 0.85rem;
                padding: 0.65rem 0.7rem;
            }

            .btn {
                font-size: 0.85rem;
                padding: 0.7rem;
            }
        }
    </style>

    <div class="panel-container">
        <div class="card">
            {{-- LOGO --}}
            <div class="logo">
                <img src="{{ asset('images/biolockinvertido.png') }}" alt="BioLock">
            </div>

            <h1>Bienvenido a tu Llavín Inteligente</h1>

            @if (!$dispositivo)
                <p>Parece que aún no tienes un llavín enlazado.</p>
                <p>¡No te preocupes! Puedes enlazarlo con un solo clic.</p>
                <a href="{{ route('dispositivo.enlazar-form') }}" class="btn btn-primary">Enlazar mi Llavín</a>
            @else
                <p>¡Tu llavín está listo para usar! ✅</p>
                <p>Pulsa el botón para abrirlo o añade nuevas huellas si lo deseas.</p>

                {{-- Botón abrir --}}
                <form method="POST" action="{{ route('dispositivo.abrir') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Abrir Llavín</button>
                </form>

                {{-- Formulario enrolar --}}
                <form method="POST" action="{{ route('dispositivo.enrolar') }}">
                    @csrf
                    <input type="number" name="finger_id" placeholder="ID Huella (1-127)" min="1" max="127" required>
                    <button type="submit" class="btn btn-primary">Añadir Huella</button>
                </form>
            @endif
        </div>
    </div>
</x-guest-layout>
