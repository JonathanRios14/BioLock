<x-guest-layout>
    <style>
        :root {
            --azul-oscuro: #0a1f44;
            --blanco: #ffffff;
            --gris-texto: #a0aec0;
            --azul-claro: #2b6cb0;
        }

        * {
            box-sizing: border-box; /* evita overflow por padding */
        }

        body {
            background-color: var(--azul-oscuro);
            color: var(--blanco);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin: 0;
            padding: 1rem;
        }

        .card {
            background-color: var(--blanco);
            color: #111827;
            border-radius: 1rem;
            padding: 2rem;
            margin-top: 2rem;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 6px 20px rgba(0,0,0,0.25);
            text-align: center;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        h2 {
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        p {
            margin-bottom: 1.5rem;
            color: #718096;
            font-size: 0.95rem;
        }

        label {
            font-weight: 500;
            display: block;
            margin-bottom: 0.3rem;
            color: #0a1f44;
        }

        input {
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid #d1d5db;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }

        .btn {
            width: 100%;
            padding: 0.9rem;
            border-radius: 0.75rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            background-color: var(--azul-claro);
            color: var(--blanco);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #153e75;
        }

        /* RESPONSIVE */
        @media (max-width: 480px) {
            .card {
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.3rem;
            }

            p {
                font-size: 0.85rem;
            }

            input {
                font-size: 0.9rem;
                padding: 0.75rem 0.85rem;
            }

            .btn {
                font-size: 0.95rem;
                padding: 0.85rem;
            }
        }

        @media (max-width: 360px) {
            .card {
                padding: 1.2rem;
            }

            h2 {
                font-size: 1.2rem;
            }

            input {
                font-size: 0.85rem;
                padding: 0.7rem 0.75rem;
            }

            .btn {
                font-size: 0.9rem;
                padding: 0.75rem;
            }
        }
    </style>

    <div class="card">
        <h2>Enlazar tu llavín inteligente</h2>
        <p>Introduce el código que muestra tu llavín en el dispositivo físico</p>

        <x-auth-session-status class="mb-3" :status="session('status')" />

        <form method="POST" action="{{ route('dispositivo.enlazar') }}">
            @csrf
            <label for="codigo">Código del llavín</label>
            <input type="text" name="codigo" id="codigo" placeholder="Ej: ABC1234" required>
            <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
            <button type="submit" class="btn">Enlazar dispositivo</button>
        </form>
    </div>
</x-guest-layout>
