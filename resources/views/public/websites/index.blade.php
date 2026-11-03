<x-layouts.public :title="'Sitios Web'">
    <div class="bg-gradient-to-b from-primary-950 via-primary-900 to-slate-900 py-14 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="inline-flex items-center gap-2 rounded-full bg-accent-500/10 px-3.5 py-1 text-xs font-semibold text-accent-300 mb-3 border border-accent-400/20">
                <span class="h-1.5 w-1.5 rounded-full bg-accent-400"></span>
                <span>Recursos Digitales Recomendados</span>
            </div>
            <h1 class="text-3xl font-black sm:text-4xl lg:text-5xl tracking-tight">Sitios Web de Interés</h1>
            <p class="mt-3 max-w-2xl text-sm sm:text-base text-slate-300">
                Directorio curado de plataformas, repositorios externos, redes académicas y fuentes documentales especializadas en Ciencias Humanas.
            </p>
        </div>
    </div>

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        {{-- Buscador --}}
        <div class="mb-10 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
            <form method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <label for="website-search" class="sr-only">Buscar sitio web</label>
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input id="website-search"
                           type="text"
                           name="q"
                           value="{{ request('q') }}"
                           placeholder="Buscar por título, temática o descripción..."
                           class="w-full rounded-xl border-slate-200 pl-10 pr-4 py-2.5 text-sm focus:border-primary-500 focus:ring-primary-500">
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-700 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-800">
                        <span>Buscar</span>
                    </button>

                    @if(request('q'))
                        <a href="{{ route('websites.index') }}"
                           class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50">
                            Limpiar
                        </a>
                    @endif
                </div>
            </form>
        </div>

        @if($items->isEmpty())
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50 text-primary-600 mb-4">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="12" r="8.5" /><path stroke-linecap="round" d="M3.5 12h17M12 3.5c2.5 2.5 2.5 15.5 0 17M12 3.5c-2.5 2.5-2.5 15.5 0 17" />
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-800">
                    {{ request('q') ? 'No se encontraron sitios con ese criterio' : 'Aún no hay sitios web registrados' }}
                </h3>
                <p class="mt-1 text-sm text-slate-500">
                    {{ request('q') ? 'Prueba con otro término de búsqueda.' : 'Pronto se añadirán enlaces a portales y repositorios académicos.' }}
                </p>
                @if(request('q'))
                    <a href="{{ route('websites.index') }}" class="btn-primary mt-4">Ver todos los sitios web</a>
                @endif
            </div>
        @else
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($items as $item)
                    <x-card :title="$item->title"
                            :category="$item->category?->name ?? 'Portal Web'"
                            href="{{ route('websites.show', $item) }}"
                            actionText="Ver ficha y enlace">
                        {{ Str::limit($item->description, 110) }}
                    </x-card>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $items->links() }}
            </div>
        @endif
    </section>
</x-layouts.public>
