<x-guest-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0V4LLanw2qksYuGW8XIRz8b+u02P+k/fKj2XQ6JzIeF3/9wD/A/gC4T6MTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* === TUS VARIABLES DE COLOR (AJUSTADAS PARA FONDO CLARO) === */
        :root {
            --azul-oscuro: #0a1f44;
            --azul-medio: #153e75;
            --azul-claro: #2b6cb0;
            --blanco: #ffffff;
            --gris-claro: #f2f4f8;
            --gris-texto: #a0aec0;
            --sombra-nav: 0 -4px 15px rgba(0, 0, 0, 0.08);
            --sombra-flotante: 0 4px 15px rgba(0, 0, 0, 0.25);
        }

        * {
            box-sizing: border-box;
        }

        /* === ESTILOS BASE Y ESTRUCTURA === */
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--gris-claro);
            color: var(--azul-oscuro);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 1rem;
            padding-bottom: 100px;
            width: 100%;
        }

        .panel-container {
            width: 100%;
            max-width: 420px;
        }

        /* === ESTILOS DE LA CARD Y BOTONES === */
        .card {
            background-color: var(--blanco);
            color: var(--azul-oscuro);
            border-radius: 1.25rem;
            padding: 2rem;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            width: 100%;
            text-align: center;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
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
            color: var(--azul-oscuro);
        }

        input[type="number"] {
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid #cbd5e0;
            margin-top: 0.5rem;
            font-size: 1rem;
            color: var(--azul-oscuro);
            background-color: var(--gris-claro);
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

        /* Estilo para el botón Añadir Huella en la tarjeta */
        .btn-secondary {
            display: block;
            background-color: #e2e8f0;
            color: var(--azul-oscuro);
        }

        .btn-secondary:hover {
            background-color: #cbd5e0;
        }

        /* Oculta los botones duplicados en la tarjeta */
        .btn-nav-hidden {
            display: none !important;
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

        /* 4 Items (Perfil, Huella, Espacio para Floating, Salir) */
        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 500;
            width: 25%; /* 4 elementos, 25% cada uno */
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
            /* Usamos 'a' en lugar de 'form' para navegación a 'panel' */
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
    </style>

    <div class="main-content">
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
                    <p>Pulsa el botón para abrirlo.</p>

                    <form method="POST" action="{{ route('dispositivo.abrir') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-lock-open me-2"></i> Abrir Llavín
                        </button>
                    </form>

                    {{-- **AJUSTE 1:** BOTÓN "AÑADIR HUELLA" VISIBLE EN LA CARD (DEBAJO DE ABRIR) --}}
                    <form method="POST" action="{{ route('dispositivo.enrolar') }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary">
                            <i class="fas fa-fingerprint me-2"></i> Añadir Huella
                        </button>
                    </form>
                @endif

                {{-- Ocultar el botón de Cerrar Sesión (sigue oculto aquí) --}}
                <form method="POST" action="{{ route('logout') }}" class="btn-nav-hidden">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Cerrar Sesión</button>
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

            <div class="floating-button-wrapper">
                <a href="{{ route('panel') }}" class="floating-button" title="Inicio">
                    <i class="nav-icon fas fa-home"></i>
                </a>
            </div>

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
