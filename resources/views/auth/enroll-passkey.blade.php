<x-guest-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0V4LLanw2qksYuGW8XIRz8b+u02P+k/fKj2XQ6JzIeF3/9wD/A/gC4T6MTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* === TUS VARIABLES DE COLOR === */
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
            background-color: var(--gris-claro); /* Fondo claro de la segunda vista */
            color: var(--azul-oscuro);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            align-items: flex-start; /* Alineación arriba para dejar espacio al menú */
            justify-content: center;
            padding: 1rem;
            padding-bottom: 100px; /* Espacio para el menú inferior */
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

        /* === TÍTULO Y DESCRIPCIÓN (Passkey View) === */
        .title {
            font-weight: 700;
            font-size: 1.5rem; /* Ajustado para ser más prominente */
            margin: 0 0 .5rem;
            color: var(--azul-oscuro);
        }

        .desc {
            color: #4b5563;
            font-size: .95rem;
            margin: 0 0 1.5rem; /* Aumento de margen inferior */
        }

        /* === BOTÓN PRINCIPAL (Passkey View) === */
        .btn {
            display: block;
            width: 100%;
            padding: 0.9rem;
            margin-top: 1rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            border: 1px solid #cbd5e0;
            background-color: var(--azul-claro); /* Usando el color primario de la segunda vista */
            color: var(--blanco);
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: var(--azul-medio);
            transform: scale(1.01);
        }

        /* === RESULTADO Y VOLVER (Passkey View) === */
        .muted {
            margin-top: 1.25rem;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-size: .9rem;
            color: #153e75; /* Texto más visible */
            background-color: var(--gris-claro);
        }

        .back {
            display: block;
            margin-top: 1.5rem;
            text-align: center;
            color: var(--azul-claro);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }
        .back:hover {
            color: var(--azul-medio);
            text-decoration: underline;
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
            width: 33.33%; /* Ajustado para 3 elementos visibles: Perfil, (Espacio Flotante), Salir */
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
    </style>

    <div class="main-content">
        <div class="panel-container">
            <div class="card">
                <div class="title">Asignar Huella / FaceID (Passkey)</div>
                <p class="desc">Registra una passkey para iniciar sesión sin contraseña en este dispositivo. Esto es más seguro que usar solo la contraseña.</p>

                <button id="btn-register-passkey" class="btn">
                    <i class="fas fa-fingerprint me-2"></i> Registrar Huella / FaceID
                </button>

                <div id="passkey-register-result" class="muted">
                    Esperando su acción...
                </div>

                <a class="back" href="{{ route('dashboard') }}">Volver al panel</a>
            </div>
        </div>
    </div>

    <div class="bottom-nav-wrapper">
        <nav class="bottom-nav">

            {{-- 1. Perfil --}}
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

            <form method="POST" action="{{ route('logout') }}" class="nav-item">
                @csrf
                <button type="submit" style="background: none; border: none; padding: 0; color: inherit; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer;">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <span>Salir</span>
                </button>
            </form>
        </nav>
    </div>

    <script>
        async function b64uToBuf(s) {
            const p = '='.repeat((4 - s.length % 4) % 4);
            const b = (s + p).replace(/-/g, '+').replace(/_/g, '/');
            const r = atob(b);
            const a = new Uint8Array(r.length);
            for (let i = 0; i < r.length; i++) a[i] = r.charCodeAt(i);
            return a.buffer;
        }

        async function bufToB64u(buf) {
            const a = new Uint8Array(buf);
            let s = '';
            for (const b of a) s += String.fromCharCode(b);
            return btoa(s).replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/, '');
        }

        (function() {
            const btn = document.getElementById('btn-register-passkey');
            const out = document.getElementById('passkey-register-result');
            if (!btn) return;

            if (!('credentials' in navigator) || !('PublicKeyCredential' in window)) {
                out.textContent = 'Este navegador no soporta Passkeys.';
                btn.disabled = true;
                return;
            }

            // Usar la ruta 'dashboard' o 'panel' según lo que corresponda en Laravel
            const urlOptions = `{{ route('passkeys.register.options', absolute: false) }}`;
            const urlStore   = `{{ route('passkeys.register.store',   absolute: false) }}`;

            btn.addEventListener('click', async () => {
                btn.disabled = true;
                out.textContent = 'Preparando…';
                try {
                    const optRes = await fetch(urlOptions, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        credentials: 'include'
                    });

                    if (!optRes.ok) {
                        const txt = await optRes.text();
                        throw new Error(`OPTIONS ${optRes.status}: ${txt.substring(0,180)}`);
                    }

                    const options = await optRes.json();

                    options.challenge = await b64uToBuf(options.challenge);
                    options.user.id = await b64uToBuf(options.user.id);
                    if (options.excludeCredentials) {
                        options.excludeCredentials = await Promise.all(
                            options.excludeCredentials.map(async c => {
                                c.id = await b64uToBuf(c.id);
                                return c;
                            })
                        );
                    }

                    const cred = await navigator.credentials.create({ publicKey: options });

                    const payload = {
                        id: cred.id,
                        type: cred.type,
                        rawId: await bufToB64u(cred.rawId),
                        response: {
                            attestationObject: await bufToB64u(cred.response.attestationObject),
                            clientDataJSON: await bufToB64u(cred.response.clientDataJSON),
                            transports: cred.response.getTransports ? cred.response.getTransports() : undefined
                        },
                        clientExtensionResults: cred.getClientExtensionResults ? cred.getClientExtensionResults() : {}
                    };

                    const saveRes = await fetch(urlStore, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]')?.content) ?? '{{ csrf_token() }}'
                        },
                        credentials: 'include',
                        body: JSON.stringify(payload)
                    });

                    if (!saveRes.ok) throw new Error(await saveRes.text());
                    out.textContent = '✅ Passkey registrada. Ya puedes usar “Entrar con huella” en el login.';
                } catch (e) {
                    out.textContent = '❌ ' + (e?.message || e);
                } finally {
                    btn.disabled = false;
                }
            });
        })();
    </script>

</x-guest-layout>
