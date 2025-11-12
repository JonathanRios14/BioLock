<x-guest-layout>
    <style>
        :root { --azul-oscuro:#0a1f44; --azul-medio:#153e75; --azul-claro:#2b6cb0; --blanco:#ffffff; --gris-claro:#f2f4f8; --gris-texto:#a0aec0; }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Inter', sans-serif; background: linear-gradient(180deg, var(--azul-oscuro) 0%, var(--azul-medio) 100%); color: var(--blanco); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 1rem; }
        .register-container { width: 100%; max-width: 420px; }
        .card { background-color: var(--blanco); border-radius: 1.25rem; padding: 2rem; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25); width: 100%; transition: all 0.3s ease; }
        .card:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3); }
        .logo { text-align: center; margin-bottom: 1.2rem; }
        .logo img { height: 180px; max-width: 100%; display: block; margin: 0 auto; }
        h1 { font-size: 1.6rem; color: var(--blanco); font-weight: 600; margin-top: .5rem; text-align: center; }
        p.subtitle { text-align: center; color: var(--gris-texto); font-size: .95rem; margin-bottom: 1.3rem; }
        label { font-size: .9rem; color: var(--azul-oscuro); font-weight: 500; display: block; margin-bottom: .3rem; }
        input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: .85rem 1rem; border: 1px solid #d1d5db; border-radius: .75rem; font-size: .95rem; color: #111827; background-color: #f9fafb; transition: border .3s, box-shadow .3s; }
        input:focus { outline: none; border-color: var(--azul-claro); box-shadow: 0 0 0 3px rgba(43,108,176,.2); }
        .btn { display: block; width: 100%; text-align: center; padding: .9rem; border-radius: .75rem; font-weight: 600; font-size: 1rem; border: none; cursor: pointer; transition: all .3s ease; }
        .btn:hover { transform: scale(1.02); }
        .btn-primary { background-color: var(--azul-claro); color: var(--blanco); }
        .btn-primary:hover { background-color: var(--azul-medio); }
        .btn-outline { background-color: var(--blanco); color: var(--azul-oscuro); border: 1px solid #cbd5e0; }
        .btn-outline:hover { background-color: #edf2f7; }
        .passkey-card { margin-top: 1rem; background:#f8fafc; border:1px solid #e5e7eb; border-radius:1rem; padding:1rem; color:#111827; }
        .passkey-title { font-weight: 600; margin-bottom: .25rem; }
        .passkey-desc { font-size: .9rem; color: #4b5563; margin-bottom: .75rem; }
        .muted { color:#6b7280; font-size:.85rem; }
        @media (max-width: 768px) { body { padding: 1rem; align-items: flex-start; } .card { padding: 1.6rem; } h1 { font-size: 1.3rem; } .logo img { height: 160px; } }
        @media (max-width: 480px) { body { padding: .5rem; } .register-container { max-width: 100%; padding: 0 .5rem; } .card { padding: 1.2rem; border-radius: 1rem; } h1 { font-size: 1.2rem; } p.subtitle { font-size: .85rem; } input, .btn { font-size: .9rem; } }
        @media (max-width: 360px) { .card { padding: 1rem; } input[type="text"], input[type="email"], input[type="password"] { font-size: .85rem; padding: .7rem .8rem; } }
    </style>

    <div class="register-container">
        <div class="logo">
            <img src="{{ asset('images/biolockpng.png') }}" alt="BioLock">
            <h1>Crear cuenta</h1>
            <p class="subtitle">Regístrate para comenzar a usar tu llavín inteligente</p>
        </div>

        <div class="card">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="name">Nombre completo</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Tu nombre">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div style="margin-top: 1rem;">
                    <label for="email">Correo electrónico</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="tucorreo@ejemplo.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div style="margin-top: 1rem;">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div style="margin-top: 1rem;">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div style="margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                    <a href="{{ route('login') }}" class="btn btn-outline" style="margin-top:.8rem;">Ya tengo una cuenta</a>
                </div>
            </form>

            @if (session('just_registered') || auth()->check())
                <div class="passkey-card">
                    <div class="passkey-title">Asignar huella / FaceID (Passkey)</div>
                    <div class="passkey-desc">Registra una passkey para iniciar sesión sin contraseña en este dispositivo.</div>
                    <button id="btn-register-passkey" class="btn btn-outline">Registrar huella / FaceID</button>
                    <div id="passkey-register-result" class="mt-2 muted"></div>
                    <div class="muted" style="margin-top:.5rem;">Consejo: usa siempre tu dominio <strong>https</strong> (ngrok) cuando registres passkeys.</div>
                </div>
            @endif
        </div>
    </div>

    <script>
        async function b64uToBuf(s){ const p='='.repeat((4-s.length%4)%4); const b=(s+p).replace(/-/g,'+').replace(/_/g,'/'); const r=atob(b); const a=new Uint8Array(r.length); for (let i=0;i<r.length;i++) a[i]=r.charCodeAt(i); return a.buffer; }
        async function bufToB64u(buf){ const a=new Uint8Array(buf); let s=''; for (const b of a) s+=String.fromCharCode(b); return btoa(s).replace(/\+/g,'-').replace(/\//g,'_').replace(/=+$/,''); }

        (function(){
            const btn = document.getElementById('btn-register-passkey');
            const out = document.getElementById('passkey-register-result');
            if (!btn) return;

            if (!('credentials' in navigator) || !('PublicKeyCredential' in window)) {
                out.textContent = 'El navegador no soporta Passkeys en este dispositivo.'; btn.disabled = true; return;
            }

            const urlOptions = `{{ route('passkeys.register.options', absolute: false) }}`;
            const urlStore   = `{{ route('passkeys.register.store',   absolute: false) }}`;

            btn.addEventListener('click', async () => {
                btn.disabled = true; out.textContent = 'Preparando…';
                try {
                    const optRes = await fetch(urlOptions, { method: 'GET', headers: { 'X-Requested-With': 'XMLHttpRequest' }, credentials: 'include' });
                    if (!optRes.ok) throw new Error('No se pudieron obtener las opciones.');
                    const options = await optRes.json();

                    options.challenge = await b64uToBuf(options.challenge);
                    options.user.id   = await b64uToBuf(options.user.id);
                    if (options.excludeCredentials) {
                        options.excludeCredentials = await Promise.all(options.excludeCredentials.map(async c => (c.id = await b64uToBuf(c.id), c)));
                    }

                    const cred = await navigator.credentials.create({ publicKey: options });

                    const payload = {
                        id: cred.id, type: cred.type, rawId: await bufToB64u(cred.rawId),
                        response: {
                            attestationObject: await bufToB64u(cred.response.attestationObject),
                            clientDataJSON:    await bufToB64u(cred.response.clientDataJSON),
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
