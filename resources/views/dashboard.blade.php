<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel del Llavín') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status'))
                <div class="mb-4 p-3 border rounded bg-green-50 text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Acciones --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-wrap gap-4 items-end">
                    <form method="POST" action="{{ route('dispositivo.abrir') }}">
                        @csrf
                        <button class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                            🔓 Abrir ahora
                        </button>
                    </form>

                    <form method="POST" action="{{ route('dispositivo.enrolar') }}" class="flex items-end gap-2">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium">ID para enrolar (1–127)</label>
                            <input type="number" name="finger_id" min="1" max="127"
                                   class="border rounded w-32 p-2" value="12" required />
                        </div>
                        <button class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
                            ✍️ Iniciar enrolado
                        </button>
                    </form>
                </div>
            </div>

            {{-- Eventos --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold">📝 Últimos eventos</h3>
                    <span class="text-xs text-gray-500">Se actualiza cada 5 s</span>
                </div>

                <div id="eventos" class="mt-3">
                    @forelse ($eventos as $e)
                        <div class="border-b py-2 text-sm">
                            <div class="font-medium">
                                {{ $e->evento }}
                                <span class="text-gray-500">({{ $e->created_at->format('Y-m-d H:i:s') }})</span>
                            </div>
                            @if($e->carga)
                                <pre class="text-gray-600 whitespace-pre-wrap">{{ json_encode($e->carga, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) }}</pre>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500">Sin eventos todavía.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    <script>
        // Refresco simple cada 5 segundos
        async function refrescarEventos() {
            try {
                const r = await fetch('{{ route('panel.eventos') }}', { headers: { 'Accept': 'application/json' } });
                const data = await r.json();
                const cont = document.getElementById('eventos');
                cont.innerHTML = data.map(e => `
                    <div class="border-b py-2 text-sm">
                        <div class="font-medium">${e.evento}
                            <span class="text-gray-500">(${new Date(e.created_at).toLocaleString()})</span>
                        </div>
                        ${e.carga ? `<pre class="text-gray-600 whitespace-pre-wrap">${JSON.stringify(e.carga, null, 2)}</pre>` : ''}
                    </div>
                `).join('') || '<p class="text-gray-500">Sin eventos todavía.</p>';
            } catch (_) {}
        }
        setInterval(refrescarEventos, 5000);
    </script>
</x-app-layout>
