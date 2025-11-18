<x-guest-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0V4LLanw2qksYuGW8XIRz8b+u02P+k/fKj2XQ6JzIeF3/9wD/A/gC4T6MTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* === VARIABLES DE COLOR === */
        :root {
            --azul-oscuro: #0a1f44;
            --azul-medio: #153e75;
            --azul-claro: #2b6cb0;
            --blanco: #ffffff;
            --gris-claro: #f2f4f8; /* Nuevo fondo de la vista principal */
            --gris-texto: #a0aec0;
            --sombra-nav: 0 -4px 15px rgba(0, 0, 0, 0.08);
            --sombra-flotante: 0 4px 15px rgba(0, 0, 0, 0.25);
        }

        * {
            box-sizing: border-box;
        }

        /* === ESTILOS BASE Y ESTRUCTURA === */
        body {
            /* Cambio de fondo de azul-oscuro a gris-claro para mantener la consistencia del panel */
            background-color: var(--gris-claro);
            color: var(--azul-oscuro);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column; /* Importante para el menú inferior */
            margin: 0;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            align-items: flex-start; /* Alineación arriba para el card */
            justify-content: center;
            padding: 1rem;
            padding-bottom: 100px; /* Espacio para el menú inferior */
            width: 100%;
        }

        .panel-container {
            width: 100%;
            max-width: 420px;
        }

        .card {
            background-color: var(--blanco);
            color: #111827;
            border-radius: 1.25rem; /* Ajustado para el estilo del panel */
            padding: 2rem;
            margin-top: 2rem;
            width: 100%;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1); /* Sombra suave */
            text-align: center;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        h2 {
            margin-bottom: 1rem;
            font-size: 1.5rem;
            color: var(--azul-oscuro);
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
            color: var(--azul-oscuro);
            text-align: left; /* Alineado a la izquierda */
        }

        input {
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid #d1d5db;
            font-size: 0.95rem;
            margin-bottom: 1rem;
            background-color: var(--gris-claro); /* Estilo de input consistente */
            color: var(--azul-oscuro);
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
            background-color: var(--azul-medio);
        }

        /* === BARRA DE NAVEGACIÓN INFERIOR (BOTTOM NAV) === */

        .bottom-nav-wrapper {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
            padding: 0 1rem 1rem 1rem;
            pointer-events: none;
        }

        .bottom-nav {
            position: relative;
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            max-width: 500px;
            height: 65px;
            background-color: var(--blanco);
            box-shadow: var(--sombra-nav);
            border-radius: 2rem;
            pointer-events: auto;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 500;
            width: 33.33%; /* 3 elementos visibles */
            height: 100%;
            color: var(--gris-texto);
            transition: color 0.2s ease, transform 0.2s ease;
            position: relative;
            z-index: 1;
            padding-top: 5px;
        }

        .nav-item button {
            background: none;
            border: none;
            padding: 0;
            color: inherit;
            font: inherit;
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .nav-item:hover {
            color: var(--azul-medio);
            transform: translateY(-2px);
        }

        .nav-item.active {
            color: var(--azul-claro);
        }

        .nav-icon {
            font-size: 1.3rem;
            margin-bottom: 2px;
        }

        /* === BOTÓN CENTRAL FLOTANTE (INICIO) === */
        .floating-button-wrapper {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            pointer-events: auto;
        }

        .floating-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--azul-medio);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--sombra-flotante);
            cursor: pointer;
            transition: transform 0.2s ease;
            border: 4px solid var(--blanco);
            text-decoration: none;
        }

        .floating-button:hover {
            transform: scale(1.05);
        }

        .floating-button .nav-icon {
            font-size: 1.8rem;
            color: var(--blanco);
            margin: 0;
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

    <div class="main-content">
        <div class="panel-container">
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
        </div>
    </div>

    <div class="bottom-nav-wrapper">
        <nav class="bottom-nav">

            <a href="{{ route('profile.edit') }}" class="nav-item">
                <i class="nav-icon fas fa-user"></i>
                <span>Perfil</span>
            </a>

            {{-- 2. Botón Flotante (Inicio / Dashboard) --}}
            <div class="floating-button-wrapper">
                <a href="{{ route('dashboard') }}" class="floating-button" title="Inicio">
                    <i class="nav-icon fas fa-home"></i>
                </a>
            </div>

            {{-- 3. Salir (Logout) --}}
            <form method="POST" action="{{ route('logout') }}" class="nav-item">
                @csrf
                <button type="submit" style="background: none; border: none; padding: 0; color: inherit; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer;">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <span>Salir</span>
                </button>
            </form>
        </nav>
    </div>
</x-guest-layout>
