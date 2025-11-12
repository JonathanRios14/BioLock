<x-guest-layout>
    <style>
        :root { --azul-oscuro:#0a1f44; --azul-medio:#153e75; --azul-claro:#2b6cb0; --blanco:#ffffff; --gris-claro:#f2f4f8; --gris-texto:#a0aec0; }
        *{ box-sizing:border-box; }
        body{ margin:0; font-family:'Inter',sans-serif; background:linear-gradient(180deg,var(--azul-oscuro) 0%,var(--azul-medio) 100%); color:var(--blanco); min-height:100vh; display:flex; justify-content:center; align-items:flex-start; padding:1rem; }
        .login-container{ width:100%; max-width:480px; }
        .card{ background:var(--blanco); border-radius:1.5rem; padding:2.2rem; box-shadow:0 6px 25px rgba(0,0,0,.25); width:100%; }
        .logo{ text-align:center; margin-bottom:1.5rem; }
        .logo img{ height:200px; max-width:100%; display:block; margin:0 auto; }
        h1{ font-size:1.8rem; color:var(--blanco); font-weight:600; margin:.5rem 0; text-align:center; }
        p.subtitle{ text-align:center; color:var(--gris-texto); font-size:1rem; margin-bottom:1.5rem; }
        label{ font-size:1rem; color:var(--azul-oscuro); font-weight:500; display:block; margin-bottom:.4rem; }
        input[type="email"],input[type="password"]{ width:100%; padding:1rem; border:1px solid #d1d5db; border-radius:.85rem; font-size:1rem; color:#111827; background:#f9fafb; }
        input:focus{ outline:none; border-color:var(--azul-claro); box-shadow:0 0 0 3px rgba(43,108,176,.2); }
        .remember{ display:flex; align-items:center; gap:.5rem; margin-top:.7rem; color:var(--azul-oscuro); font-size:1rem; }
        .btn{ display:block; width:100%; text-align:center; padding:1rem; border-radius:.85rem; font-weight:600; font-size:1.05rem; border:none; cursor:pointer; transition:all .3s; }
        .btn-primary{ background:var(--azul-claro); color:var(--blanco); } .btn-primary:hover{ background:var(--azul-medio); }
        .btn-outline{ background:var(--blanco); color:var(--azul-oscuro); border:1px solid #cbd5e0; } .btn-outline:hover{ background:#edf2f7; }
        .hint{ font-size:.9rem; color:#4b5563; margin-top:.5rem; text-align:center; }
        .alert{ margin-top:.75rem; background:#eff6ff; color:#1e40af; border:1px solid #bfdbfe; border-radius:.75rem; padding:.75rem .9rem; font-size:.9rem; }
        @media (max-width:768px){ .login-container{ max-width:420px; } .card{ padding:2rem; } .logo img{ height:180px; } h1{ font-size:1.6rem; } p.subtitle{ font-size:.95rem; } input,.btn,label,.remember{ font-size:.95rem; padding:.9rem; } }
        @media (max-width:480px){ .login-container{ max-width:100%; padding:0 .5rem; } .card{ padding:1.6rem; border-radius:1.25rem; } .logo img{ height:160px; } h1{ font-size:1.4rem; } p.subtitle{ font-size:.9rem; } input,.btn,label,.remember{ font-size:.9rem; padding:.85rem; } }
        @media (max-width:360px){ .card{ padding:1.3rem; } .logo img{ height:140px; } h1{ font-size:1.3rem; } p.subtitle{ font-size:.85rem; } input,.btn,label,.remember{ font-size:.85rem; padding:.75rem; } }
    </style>

    {{-- Si viene con ?enroll_notice=1 mostramos el aviso y guardamos el intended --}}
    @php
        if (request()->boolean('enroll_notice')) {
            // Guarda la ruta de enrolar como URL "intended" para que redirija allí después del login normal
            session(['url.intended' => route('passkeys.enroll')]);
        }
    @endphp

    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('images/biolockpng.png') }}" alt="BioLock">
            <h1>Bienvenido a BioLock</h1>
            <p class="subtitle">Accede para controlar tu llavín inteligente</p>
        </div>

        <div class="card">
            {{-- Mensaje informativo si venimos de “Regístrala aquí” --}}
            @if (request()->boolean('enroll_notice'))
                <div class="alert">Para registrar tu huella / FaceID, primero inicia sesión y te llevaremos a la pantalla de asignación.</div>
            @endif

            <x-auth-session-status class="mb-3" :status="session('status')" />

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

                <label for="remember_me" class="remember">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>Recordarme</span>
                </label>

                <div style="margin-top:1.3rem;">
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline" style="margin-top:.7rem;">Crear cuenta</a>
                    @endif
                </div>
            </form>

            <div style="display:flex;align-items:center;gap:.75rem;margin:1.25rem 0;">
                <hr style="flex:1;border:none;border-top:1px solid #e5e7eb;">
                <span style="color:#6b7280;font-size:.9rem;">o</span>
                <hr style="flex:1;border:none;border-top:1px solid #e5e7eb;">
            </div>

            <div>
                <button id="btn-login-passkey" type="button" class="btn btn-outline">
                    Entrar con huella / FaceID
                </button>
                <div id="passkey-login-result" class="mt-2" style="color:#4b5563;font-size:.9rem;"></div>
                <div class="hint">
                    {{-- Enviar aviso y preparar intended para que, tras login, vaya a /passkeys/enroll --}}
                    ¿Aún no tienes huella?
                    <a href="{{ route('login', ['enroll_notice' => 1, 'next' => route('passkeys.enroll', [], false)]) }}">
                        Regístrala aquí
                    </a>.
                </div>
            </div>
        </div>
    </div>

    <script>
        async function b64uToBuf(s){ const p='='.repeat((4-s.length%4)%4); const b=(s+p).replace(/-/g,'+').replace(/_/g,'/'); const r=atob(b); const a=new Uint8Array(r.length); for(let i=0;i<r.length;i++) a[i]=r.charCodeAt(i); return a.buffer; }
        async function bufToB64u(buf){ const a=new Uint8Array(buf); let s=''; for(const b of a) s+=String.fromCharCode(b); return btoa(s).replace(/\+/g,'-').replace(/\//g,'_').replace(/=+$/,''); }

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
                        headers:{'X-Requested-With':'XMLHttpRequest', 'Accept':'application/json'},
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

                    // Si el backend algún día responde con redirect 302
                    if (loginRes.redirected){ window.location.href = loginRes.url; return; }

                    // Si responde JSON con redirect (opcional)
                    if (loginRes.headers.get('content-type')?.includes('application/json')) {
                        const data = await loginRes.json().catch(() => ({}));
                        if (loginRes.ok && data?.redirect) { window.location.href = data.redirect; return; }
                    }

                    // Caso actual: 204 No Content -> redirigimos al dashboard
                    if (loginRes.ok) { window.location.href = "{{ route('dashboard') }}"; return; }

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
