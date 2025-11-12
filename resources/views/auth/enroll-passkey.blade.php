<x-guest-layout>
    <style>
        :root { --azul-oscuro:#0a1f44; --azul-medio:#153e75; --azul-claro:#2b6cb0; --blanco:#ffffff; --gris-texto:#6b7280; }
        *{ box-sizing:border-box; }
        body{ margin:0; font-family:'Inter',sans-serif; background:linear-gradient(180deg,var(--azul-oscuro),var(--azul-medio)); color:var(--blanco); min-height:100vh; display:flex; justify-content:center; align-items:center; padding:1rem; }
        .wrap{ width:100%; max-width:420px; }
        .card{ background:#fff; color:#111827; border-radius:1.25rem; padding:1.75rem; box-shadow:0 6px 20px rgba(0,0,0,.25); }
        .title{ font-weight:700; font-size:1.2rem; margin:0 0 .35rem; }
        .desc{ color:#4b5563; font-size:.95rem; margin:0 0 1rem; }
        .btn{ width:100%; padding:1rem; border-radius:.85rem; font-weight:600; border:1px solid #cbd5e0; background:#fff; cursor:pointer; }
        .btn:hover{ background:#edf2f7; }
        .muted{ margin-top:.75rem; font-size:.9rem; color:var(--gris-texto); }
        .back{ display:block; margin-top:1rem; text-align:center; color:#2b6cb0; }
    </style>

    <div class="wrap">
        <div class="card">
            <div class="title">Asignar huella / FaceID (Passkey)</div>
            <p class="desc">Registra una passkey para iniciar sesión sin contraseña en este dispositivo.</p>

            <button id="btn-register-passkey" class="btn">Registrar huella / FaceID</button>
            <div id="passkey-register-result" class="muted"></div>
            <a class="back" href="{{ route('dashboard') }}">Volver al panel</a>
        </div>
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

            const urlOptions = `{{ route('passkeys.register.options', absolute: false) }}`;
            const urlStore   = `{{ route('passkeys.register.store',   absolute: false) }}`;

            btn.addEventListener('click', async () => {
                btn.disabled = true;
                out.textContent = 'Preparando…';
                try {
                    // ✅ Aquí está la versión corregida
                    const optRes = await fetch(urlOptions, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        credentials: 'include'
                    });

                    // Muestra error si el servidor responde algo distinto de 200
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
