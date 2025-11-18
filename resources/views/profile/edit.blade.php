<x-app-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0V4LLanw2qksYuGW8XIRz8b+u02P+k/fKj2XQ6JzIeF3/9wD/A/gC4T6MTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* === VARIABLES DE COLOR (AJUSTADAS PARA FONDO CLARO) === */
        :root {
            /* Asegúrate de que estas variables coincidan con las que usas en el resto de tu app */
            --azul-oscuro: #0a1f44;
            --azul-medio: #153e75;
            --azul-claro: #2b6cb0;
            --blanco: #ffffff;
            --gris-claro: #f2f4f8;
            --gris-texto: #a0aec0;
            --sombra-nav: 0 -4px 15px rgba(0, 0, 0, 0.08);
            --sombra-flotante: 0 4px 15px rgba(0, 0, 0, 0.25);
        }

        /* === ESTILOS BASE Y ESTRUCTURA === */
        /* Asegúrate de que el body/contenedor principal permita el padding inferior */
        .main-content-profile {
            /* Simula el efecto de espacio inferior para que el contenido no quede debajo del nav */
            padding-bottom: 100px;
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
            width: 25%;
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

        /* **IMPORTANTE:** El ítem activo para Perfil */
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
    </style>

    <div class="py-12 main-content-profile">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-nav-wrapper">
        <nav class="bottom-nav">

            {{-- 1. Perfil (Ahora es el activo) --}}
            {{-- Usamos `active` para resaltar este ítem --}}
            <a href="{{ route('profile.edit') }}" class="nav-item active">
                <i class="nav-icon fas fa-user"></i>
                <span>Perfil</span>
            </a>

            {{-- 2. Botón Flotante (Inicio) --}}
            <div class="floating-button-wrapper">
                <a href="{{ route('panel') }}" class="floating-button" title="Inicio">
                    <i class="nav-icon fas fa-home"></i>
                </a>
            </div>

            {{-- 3. Salir --}}
            <form method="POST" action="{{ route('logout') }}" class="nav-item">
                @csrf
                <button type="submit" style="background: none; border: none; padding: 0; color: inherit; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer;">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <span>Salir</span>
                </button>
            </form>
        </nav>
    </div>
</x-app-layout>
