<x-guest-layout>
    <style>
        :root {
            --azul-oscuro:#0a1f44;
            --azul-medio:#153e75;
            --azul-claro:#2b6cb0;
            --blanco:#ffffff;
            --gris-claro:#f2f4f8;
            --gris-texto:#a0aec0;
        }

        *{ box-sizing:border-box; margin:0; padding:0; }
        body{
            font-family:'Inter',sans-serif;
            background:linear-gradient(180deg,var(--azul-oscuro) 0%,var(--azul-medio) 100%);
            color:var(--blanco);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:flex-start;
            padding:1rem;
            overflow:hidden;
        }

        /* ==================== Splash screen ==================== */
        .splash {
            position:fixed;
            inset:0;
            background:linear-gradient(135deg, var(--azul-oscuro), var(--azul-medio), var(--azul-claro));
            background-size:200% 200%;
            animation:bgMove 5s ease-in-out infinite alternate;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            z-index:9999;
            transition:opacity 1s ease, transform 1s ease, visibility 1s ease;
        }
        @keyframes bgMove {
            0% {background-position:0% 0%;}
            100% {background-position:100% 100%;}
        }

        .logo-wrapper {
            position:relative;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .halo {
            position:absolute;
            width:330px;
            height:330px;
            border-radius:50%;
            background:radial-gradient(circle, rgba(43,108,176,0.6) 0%, rgba(43,108,176,0.15) 40%, transparent 70%);
            filter:blur(40px);
            animation:haloPulse 3.5s ease-in-out infinite;
            z-index:0;
        }
        @keyframes haloPulse {
            0% {transform:scale(1); opacity:.7;}
            50% {transform:scale(1.15); opacity:1;}
            100% {transform:scale(1); opacity:.7;}
        }

        .splash img {
            width:240px;
            height:auto;
            animation: floatLogo 2.5s ease-in-out infinite;
            filter:drop-shadow(0 0 15px rgba(255,255,255,0.25));
            position:relative;
            z-index:2;
        }
        @keyframes floatLogo {
            0%   { transform:scale(1) translateY(0); }
            50%  { transform:scale(1.08) translateY(-10px); }
            100% { transform:scale(1) translateY(0); }
        }

        .loader {
            display:inline-flex;
            gap:10px;
            margin-top:2rem;
        }
        .loader:before,
        .loader:after {
            content:"";
            height:20px;
            aspect-ratio:1;
            border-radius:50%;
            background:
                radial-gradient(farthest-side,#000 95%,#0000) 50%/8px 8px no-repeat
                #fff;
            animation:l10 1.5s infinite alternate;
        }
        .loader:after { --s:-1; }
        @keyframes l10 {
            0%,20% {transform:scaleX(var(--s,1)) rotate(0deg);clip-path:inset(0);}
            60%,100%{transform:scaleX(var(--s,1)) rotate(30deg);clip-path:inset(40% 0 0);}
        }

        .splash.hidden {
            opacity:0;
            visibility:hidden;
            pointer-events:none;
            transform:translateY(-30px);
        }

        /* ==================== Login ==================== */
        .login-container{
            width:100%;
            max-width:480px;
            opacity:0;
            transform:translateY(20px);
            transition:opacity 1s ease, transform 1s ease;
        }
        .login-container.visible {
            opacity:1;
            transform:translateY(0);
        }

        .card{
            background:var(--blanco);
            border-radius:1.5rem;
            padding:2.2rem;
            box-shadow:0 6px 25px rgba(0,0,0,.25);
            width:100%;
        }

        h1{
            font-size:1.9rem;
            color:var(--blanco);
            font-weight:600;
            margin:.5rem 0;
            text-align:center;
        }
        p.subtitle{
            text-align:center;
            color:var(--gris-texto);
            font-size:1rem;
            margin-bottom:1.5rem;
        }

        label{
            font-size:1rem;
            color:var(--azul-oscuro);
            font-weight:500;
            display:block;
            margin-bottom:.4rem;
        }

        input[type="email"],input[type="password"]{
            width:100%;
            padding:1rem;
            border:1px solid #d1d5db;
            border-radius:.85rem;
            font-size:1rem;
            color:#111827;
            background:#f9fafb;
        }

        input:focus{
            outline:none;
            border-color:var(--azul-claro);
            box-shadow:0 0 0 3px rgba(43,108,176,.2);
        }

        .btn{
            display:block;
            width:100%;
            text-align:center;
            padding:1rem;
            border-radius:.85rem;
            font-weight:600;
            font-size:1.05rem;
            border:none;
            cursor:pointer;
            transition:all .3s;
        }

        .btn-primary{ background:var(--azul-claro); color:var(--blanco); }
        .btn-primary:hover{ background:var(--azul-medio); }

        .btn-outline{
            background:var(--blanco);
            color:var(--azul-oscuro);
            border:1px solid #cbd5e0;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:0.5rem;
        }
        .btn-outline:hover{ background:#edf2f7; }

        .hint{ font-size:.9rem; color:#4b5563; margin-top:.5rem; text-align:center; }
        .alert{ margin-top:.75rem; background:#eff6ff; color:#1e40af; border:1px solid #bfdbfe; border-radius:.75rem; padding:.75rem .9rem; font-size:.9rem; }

        /* ==================== Sección Passkey delicada ==================== */
        .passkey-section {
            margin-top:1.8rem;
            padding-top:1.4rem;
            border-top:1px solid #e5e7eb;
            text-align:center;
        }
        .passkey-title {
            font-size:.95rem;
            font-weight:600;
            color:#111827;
            margin-bottom:.9rem;
        }

        .fingerprint-button {
            margin:0 auto;
            width:82px;
            height:82px;
            border-radius:999px;
            border:1px solid #e5e7eb;
            background:#f9fafb;
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow:0 8px 16px rgba(15, 23, 42, .12);
            cursor:pointer;
            position:relative;
            overflow:hidden;
            animation:fbuttonPulse 2.4s ease-in-out infinite;
        }

        @keyframes fbuttonPulse {
            0%   { transform:translateY(0) scale(1);   box-shadow:0 8px 16px rgba(15, 23, 42, .12); }
            50%  { transform:translateY(-1px) scale(1.03); box-shadow:0 12px 22px rgba(15, 23, 42, .16); }
            100% { transform:translateY(0) scale(1);   box-shadow:0 8px 16px rgba(15, 23, 42, .12); }
        }

        .fingerprint-button::after {
            content:"";
            position:absolute;
            inset:6px;
            border-radius:inherit;
            border:1px solid rgba(148,163,184,0.35);
        }

        .fingerprint-icon-wrapper {
            position:relative;
            z-index:2;
            width:44px;
            height:44px;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .fingerprint-icon-wrapper img {
            width:100%;
            height:100%;
            object-fit:contain;
            opacity:.9;
            filter:drop-shadow(0 0 3px rgba(148,163,184,0.55));
        }

        #passkey-login-result {
            margin-top:.8rem;
        }

        @media (max-width:768px){
            .login-container{ max-width:420px; }
            .card{ padding:2rem; }
            h1{ font-size:1.6rem; }
            p.subtitle{ font-size:.95rem; }
            input,.btn,label{ font-size:.95rem; padding:.9rem; }
            .halo{ width:250px; height:250px; filter:blur(30px); }
        }
    </style>

    {{-- ==================== Splash Screen ==================== --}}
    <div class="splash" id="splash">
        <div class="logo-wrapper">
            <div class="halo"></div>
            <img src="{{ asset('images/biolockpng.png') }}" alt="BioLock">
        </div>
        <div class="loader"></div>
    </div>

    {{-- ==================== Login ==================== --}}
    @php
        if (request()->boolean('enroll_notice')) {
            session(['url.intended' => route('passkeys.enroll')]);
        }
    @endphp

    <div class="login-container" id="loginContainer">
        <h1>Bienvenido a BioLock</h1>
        <p class="subtitle">Accede para controlar tu llavín inteligente</p>

        <div class="card">
            @if (request()->boolean('enroll_notice'))
                <div class="alert">
                    Para registrar tu huella / FaceID, primero inicia sesión y te llevaremos a la pantalla de asignación.
                </div>
            @endif

            <x-auth-session-status class="mb-3" :status="session('status')" />

            {{-- ===== Formulario tradicional ===== --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email">Correo electrónico</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="tucorreo@ejemplo.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div style="margin-top:1rem;">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div style="margin-top:1.3rem;">
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline" style="margin-top:.7rem;">Crear cuenta</a>
                    @endif
                </div>
            </form>

            <div class="passkey-section">
                <p class="passkey-title">Ingresar con huella / FaceID</p>

                <button
                    id="btn-login-passkey"
                    type="button"
                    class="fingerprint-button"
                    aria-label="Entrar con huella o FaceID"
                >
                    <div class="fingerprint-icon-wrapper">
                        <img src="{{ asset('images/fingerprint.png') }}" alt="Huella digital">
                    </div>
                </button>

                <div id="passkey-login-result" style="color:#4b5563;font-size:.9rem;"></div>

                <div class="hint" style="margin-top:1.1rem;">
                    ¿Aún no tienes huella?
                    <a href="{{ route('login', ['enroll_notice' => 1, 'next' => route('passkeys.enroll', [], false)]) }}">
                        Regístrala aquí
                    </a>
                </div>
            </div>
        </div>
    </div>

    <noscript>
        <style>
            #splash { display:none !important; }
            .login-container{ opacity:1 !important; transform:translateY(0) !important; }
        </style>
    </noscript>

    <script>
        // ===== Splash fade out =====
        document.addEventListener("DOMContentLoaded", () => {
            const splash = document.getElementById('splash');
            const login = document.getElementById('loginContainer');
            setTimeout(() => {
                splash.classList.add('hidden');
                login.classList.add('visible');
                setTimeout(() => {
                    splash.remove();
                    document.body.style.overflow = 'auto';
                }, 1000);
            }, 2000);
        });

        // ===== Helpers base64url <-> ArrayBuffer =====
        async function b64uToBuf(s){
            const p='='.repeat((4-s.length%4)%4);
            const b=(s+p).replace(/-/g,'+').replace(/_/g,'/');
            const r=atob(b); const a=new Uint8Array(r.length);
            for(let i=0;i<r.length;i++) a[i]=r.charCodeAt(i);
            return a.buffer;
        }
        async function bufToB64u(buf){
            const a=new Uint8Array(buf); let s='';
            for(const b of a) s+=String.fromCharCode(b);
            return btoa(s).replace(/\+/g,'-').replace(/\//g,'_').replace(/=+$/,'');
        }

        // ===== Login con passkey =====
        (function(){
            const btn = document.getElementById('btn-login-passkey');
            const out = document.getElementById('passkey-login-result');
            if (!btn || !out) return;

            if (!('credentials' in navigator) || !('PublicKeyCredential' in window)) {
                btn.style.display = 'none';
                out.textContent = 'El navegador no soporta Passkeys en este dispositivo.';
                return;
            }

            const urlLoginOptions = `{{ route('passkeys.login.options', absolute: false) }}`;
            const urlLoginStore   = `{{ route('passkeys.login.store',   absolute: false) }}`;

            btn.addEventListener('click', async () => {
                btn.disabled = true; out.textContent = 'Preparando…';
                try {
                    const optRes = await fetch(urlLoginOptions, {
                        method:'GET',
                        headers:{
                            'X-Requested-With':'XMLHttpRequest',
                            'Accept':'application/json'
                        },
                        credentials:'include'
                    });
                    if (!optRes.ok) throw new Error('No se pudieron obtener las opciones.');
                    const options = await optRes.json();

                    options.challenge = await b64uToBuf(options.challenge);
                    if (options.allowCredentials) {
                        options.allowCredentials = await Promise.all(options.allowCredentials.map(async c => {
                            c.id = await b64uToBuf(c.id); return c;
                        }));
                    }

                    const assertion = await navigator.credentials.get({ publicKey: options });

                    const payload = {
                        id: assertion.id,
                        type: assertion.type,
                        rawId: await bufToB64u(assertion.rawId),
                        response: {
                            authenticatorData: await bufToB64u(assertion.response.authenticatorData),
                            clientDataJSON:    await bufToB64u(assertion.response.clientDataJSON),
                            signature:         await bufToB64u(assertion.response.signature),
                            userHandle: assertion.response.userHandle ? await bufToB64u(assertion.response.userHandle) : null
                        },
                        clientExtensionResults: assertion.getClientExtensionResults ? assertion.getClientExtensionResults() : {}
                    };

                    const loginRes = await fetch(urlLoginStore, {
                        method:'POST',
                        headers:{
                            'Content-Type':'application/json',
                            'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]')?.content) ?? '{{ csrf_token() }}'
                        },
                        credentials:'include',
                        body: JSON.stringify(payload)
                    });

                    if (loginRes.redirected){
                        window.location.href = loginRes.url;
                        return;
                    }

                    if (loginRes.headers.get('content-type')?.includes('application/json')) {
                        const data = await loginRes.json().catch(() => ({}));
                        if (loginRes.ok && data?.redirect) {
                            window.location.href = data.redirect;
                            return;
                        }
                    }

                    if (loginRes.ok) {
                        window.location.href = "{{ route('dashboard') }}";
                        return;
                    }

                    throw new Error(await loginRes.text());
                } catch (e) {
                    out.textContent = '❌ ' + (e?.message || e);
                } finally {
                    btn.disabled = false;
                }
            });
        })();
    </script>
</x-guest-layout>
