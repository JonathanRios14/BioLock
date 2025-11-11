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
            max-width: 400px;
        }

        .card {
            background-color: var(--blanco);
            color: var(--azul-oscuro);
            border-radius: 1.25rem;
            padding: 2rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            width: 100%;
            text-align: center;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem; /* más espacio debajo */
        }

        .logo img {
            width: 220px; /* más grande */
            height: auto;
        }

        h1 {
            font-size: 1.5rem;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        p {
            margin-bottom: 1rem;
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
            transition: background 0.3s;
        }

        .btn-primary {
            background-color: var(--azul-claro);
            color: var(--blanco);
        }

        .btn-primary:hover {
            background-color: var(--azul-medio);
        }

        input[type="number"] {
            width: 100%;
            padding: 0.8rem;
            border-radius: 0.75rem;
            border: 1px solid #cbd5e0;
            margin-top: 0.5rem;
            font-size: 1rem;
        }

        @media (max-width: 480px) {
            .card {
                padding: 1.5rem;
            }
            h1 {
                font-size: 1.3rem;
            }
            .btn {
                font-size: 0.95rem;
                padding: 0.8rem;
            }
            input[type="number"] {
                font-size: 0.95rem;
                padding: 0.7rem;
            }
            .logo img {
                width: 200px; /* más pequeño en móvil */
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
