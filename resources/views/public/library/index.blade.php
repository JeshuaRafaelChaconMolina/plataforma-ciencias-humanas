<x-layouts.public :title="'Biblioteca Virtual'">

    {{-- Encabezado editorial institucional --}}
    <section class="relative overflow-hidden border-b border-slate-200 bg-white">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -right-24 -top-32 h-96 w-96 rounded-full bg-blue-50/80 blur-3xl"></div>
            <div class="absolute bottom-0 right-1/3 h-40 w-40 rounded-full bg-amber-50/60 blur-3xl"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <div class="grid items-center gap-12 lg:grid-cols-[1.3fr_0.7fr]">

                <div>
                    <h1 class="mt-6 max-w-3xl text-4xl font-semibold leading-tight tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                        Biblioteca
                        <span class="block font-serif italic font-normal text-primary-700">
                            Virtual
                        </span>
                    </h1>

                    <p class="mt-6 max-w-xl text-base leading-8 text-slate-600 sm:text-lg">
                        Un espacio para descubrir, consultar y compartir el conocimiento.
                        Explora artículos académicos, libros y revistas que contribuyen
                        al pensamiento crítico y a la investigación.
                    </p>
                </div>

                {{-- Panel visual --}}
                <div class="hidden lg:block">
                    <div class="relative mx-auto max-w-sm">
                        <div class="absolute -right-3 -top-3 h-full w-full rounded-2xl border border-amber-200"></div>

                        <div class="relative rounded-2xl bg-primary-700 p-9 text-white shadow-xl">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-blue-200">
                                    Explora
                                </span>

                                <svg class="h-7 w-7 text-amber-400" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.4">
                                    <path d="M4 19.5V5a2 2 0 0 1 2-2h12.5v15H6a2 2 0 0 0-2 2Z"/>
                                    <path d="M6 20h12.5M8 7h7M8 10h7"/>
                                </svg>
                            </div>

                            <div class="my-9 h-px bg-white/20"></div>

                            <p class="font-serif text-3xl leading-snug">
                                Ideas que
                                <span class="italic text-amber-300">transforman</span>
                                el conocimiento.
                            </p>

                            <p class="mt-5 text-sm leading-6 text-blue-100">
                                Consulta recursos para el aprendizaje, la docencia
                                y la investigación.
                            </p>

                            <div class="mt-8 flex items-center gap-2">
                                <span class="h-1.5 w-8 rounded-full bg-amber-400"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-white/40"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-white/40"></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Navegación por tipo --}}
            <div class="mt-12 border-t border-slate-200 pt-6 sm:mt-16">
                <p class="mb-4 text-xs font-semibold uppercase tracking-widest text-slate-400">
                    Explorar colección
                </p>

                <nav class="flex flex-wrap gap-2 sm:gap-3" aria-label="Tipos de publicaciones">
                    @foreach ($tipos as $clave => $config)
                        <a
                            href="{{ route('library.index', ['tipo' => $clave]) }}"
                            @class([
                                'group inline-flex items-center gap-2.5 rounded-lg border px-4 py-3 text-sm font-semibold transition duration-200',
                                'border-primary-700 bg-primary-700 text-white shadow-sm' => $tipo === $clave,
                                'border-slate-200 bg-white text-slate-600 hover:border-primary-600/40 hover:bg-blue-50/50 hover:text-primary-700' => $tipo !== $clave,
                            ])
                            @if ($tipo === $clave) aria-current="page" @endif
                        >
                            @switch($clave)
                                @case('articulos')
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path d="M7 4h10a1 1 0 0 1 1 1v15l-3-2-3 2-3-2-3 2V5a1 1 0 0 1 1-1Z"/>
                                        <path d="M9 8h6M9 11.5h6M9 15h3"/>
                                    </svg>
                                    @break

                                @case('libros')
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path d="M4 19.5V5a2 2 0 0 1 2-2h12.5v15H6a2 2 0 0 0-2 2Z"/>
                                        <path d="M6 20h12.5"/>
                                    </svg>
                                    @break

                                @case('revistas')
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path d="M4 4h13a3 3 0 0 1 3 3v13H7a3 3 0 0 1-3-3V4Z"/>
                                        <path d="M8 9h8M8 12.5h8M8 16h4"/>
                                    </svg>
                                    @break
                            @endswitch

                            {{ $config['label'] }}

                            @if ($tipo === $clave)
                                <span class="ml-1 h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                            @endif
                        </a>
                    @endforeach
                </nav>
            </div>
        </div>
    </section>


    {{-- Contenido del repositorio --}}
    <section class="bg-slate-50/70">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-14 lg:px-8">

            {{-- Encabezado y buscador --}}
            <div class="flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-amber-700">
                        Colección digital
                    </p>

                    <h2 class="mt-2 text-2xl font-semibold tracking-tight text-slate-900 sm:text-3xl">
                        Descubre publicaciones
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Encuentra recursos por título o explora las categorías disponibles.
                    </p>
                </div>

                <form
                    method="GET"
                    action="{{ route('library.index') }}"
                    class="w-full lg:max-w-xl"
                >
                    <input type="hidden" name="tipo" value="{{ $tipo }}">

                    @if (request('categoria'))
                        <input type="hidden" name="categoria" value="{{ request('categoria') }}">
                    @endif

                    <label for="library-search" class="sr-only">
                        Buscar publicaciones
                    </label>

                    <div class="flex flex-col gap-2 rounded-xl border border-slate-200 bg-white p-2 shadow-sm focus-within:border-primary-600 focus-within:ring-4 focus-within:ring-primary-600/15 sm:flex-row">
                        <div class="relative min-w-0 flex-1">
                            <svg
                                class="pointer-events-none absolute left-3.5 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.7"
                            >
                                <circle cx="11" cy="11" r="7"/>
                                <path d="m20 20-3-3"/>
                            </svg>

                            <input
                                id="library-search"
                                type="search"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="Buscar artículos, libros, revistas..."
                                class="w-full border-0 bg-transparent py-3 pl-11 pr-3 text-sm text-slate-700 placeholder:text-slate-400 focus:border-0 focus:ring-0"
                            >
                        </div>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary-700 px-6 py-3 text-sm font-semibold text-white transition hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2"
                        >
                            Buscar
                            <svg class="h-4 w-4" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7"/>
                                <path d="m20 20-3-3"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>


            {{-- Filtros de categoría --}}
            @if ($categories->isNotEmpty())
                <div class="mt-8 border-y border-slate-200 py-5">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <span class="shrink-0 text-xs font-bold uppercase tracking-wider text-slate-400">
                            Filtrar por tema
                        </span>

                        <div class="flex flex-wrap gap-2">
                            <a
                                href="{{ route('library.index', array_filter(['tipo' => $tipo, 'q' => request('q')])) }}"
                                @class([
                                    'rounded-full px-4 py-2 text-xs font-semibold transition duration-200',
                                    'bg-primary-700 text-white' => !request('categoria'),
                                    'border border-slate-200 bg-white text-slate-600 hover:border-primary-600/40 hover:text-primary-700' => request('categoria'),
                                ])
                            >
                                Todas las categorías
                            </a>

                            @foreach ($categories as $categoria)
                                <a
                                    href="{{ route('library.index', array_filter(['tipo' => $tipo, 'q' => request('q'), 'categoria' => $categoria->slug])) }}"
                                    @class([
                                        'rounded-full px-4 py-2 text-xs font-semibold transition duration-200',
                                        'bg-primary-700 text-white' => request('categoria') === $categoria->slug,
                                        'border border-slate-200 bg-white text-slate-600 hover:border-primary-600/40 hover:text-primary-700' => request('categoria') !== $categoria->slug,
                                    ])
                                    @if (request('categoria') === $categoria->slug) aria-current="true" @endif
                                >
                                    {{ $categoria->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif


            {{-- Resultados --}}
            <div class="mt-9">

                @if ($items->isEmpty())

                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center sm:py-20">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                            <svg class="h-8 w-8" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.4">
                                <path d="M4 19.5V5a2 2 0 0 1 2-2h12.5v15H6a2 2 0 0 0-2 2Z"/>
                                <path d="M8 8h7M8 11h7M8 14h4"/>
                            </svg>
                        </div>

                        <h3 class="mt-5 text-lg font-semibold text-slate-800">
                            No encontramos publicaciones
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                            No hay resultados que coincidan con los filtros seleccionados.
                            Prueba con otro término o consulta todas las categorías.
                        </p>

                        <a
                            href="{{ route('library.index', ['tipo' => $tipo]) }}"
                            class="mt-6 inline-flex items-center gap-2 rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-semibold text-primary-700 transition hover:border-primary-600/40 hover:bg-blue-50"
                        >
                            Limpiar filtros
                        </a>
                    </div>

                @else

                    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                        <p class="text-sm text-slate-500">
                            <span class="font-semibold text-slate-900">
                                {{ $items->total() }}
                            </span>
                            {{ $items->total() === 1 ? 'publicación encontrada' : 'publicaciones encontradas' }}
                        </p>

                        <span class="inline-flex items-center gap-2 text-xs font-medium text-slate-400">
                            <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                            Recursos del repositorio
                        </span>
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($items as $item)

                            <a
                                href="{{ route($tipos[$tipo]['route'], $item) }}"
                                class="group relative flex h-full flex-col overflow-hidden rounded-xl border border-slate-200/90 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-primary-600/30 hover:shadow-[0_16px_40px_-20px_rgba(15,40,80,0.25)] focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2"
                            >
                                {{-- Detalle superior --}}
                                <div class="absolute left-0 top-0 h-1 w-12 bg-amber-500 transition-all duration-300 group-hover:w-full"></div>

                                <div class="flex items-start justify-between gap-3">
                                    <span class="inline-flex items-center rounded-md bg-blue-50 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-primary-700 ring-1 ring-inset ring-blue-100">
                                        {{ $tipos[$tipo]['label'] }}
                                    </span>

                                    @if ($item->category)
                                        <span class="max-w-[48%] text-right text-xs leading-5 text-slate-400">
                                            {{ $item->category->name }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Icono editorial --}}
                                <div class="mt-7 flex h-11 w-11 items-center justify-center rounded-xl bg-slate-50 text-primary-700 transition duration-300 group-hover:bg-primary-700 group-hover:text-white">
                                    @switch($tipo)
                                        @case('articulos')
                                            <svg class="h-5 w-5" viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M7 3.5h7l4 4V21H7a2 2 0 0 1-2-2V5.5a2 2 0 0 1 2-2Z"/>
                                                <path d="M14 3.5v5h4M8.5 13h7M8.5 16.5h7"/>
                                            </svg>
                                            @break

                                        @case('libros')
                                            <svg class="h-5 w-5" viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M5 4.5A2.5 2.5 0 0 1 7.5 2H20v17H7.5A2.5 2.5 0 0 0 5 21.5V4.5Z"/>
                                                <path d="M5 5v16.5M9 6h7"/>
                                            </svg>
                                            @break

                                        @case('revistas')
                                            <svg class="h-5 w-5" viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="1.5">
                                                <rect x="4" y="3" width="16" height="18" rx="1.5"/>
                                                <path d="M8 8h8M8 12h8M8 16h5"/>
                                            </svg>
                                            @break

                                        @default
                                            <svg class="h-5 w-5" viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M4 19.5V5a2 2 0 0 1 2-2h12.5v15H6a2 2 0 0 0-2 2Z"/>
                                                <path d="M8 8h7M8 12h7"/>
                                            </svg>
                                    @endswitch
                                </div>

                                {{-- Información --}}
                                <h3 class="mt-5 text-lg font-semibold leading-7 tracking-tight text-slate-900 transition-colors group-hover:text-primary-700">
                                    {{ $item->title }}
                                </h3>

                                @if (!empty($item->description))
                                    <p class="mt-3 line-clamp-3 flex-1 text-sm leading-7 text-slate-500">
                                        {{ $item->description }}
                                    </p>
                                @else
                                    <div class="flex-1"></div>
                                @endif

                                {{-- Acción --}}
                                <div class="mt-7 flex items-center justify-between border-t border-slate-100 pt-4">
                                    <span class="text-xs font-semibold uppercase tracking-wider text-primary-700">
                                        Consultar publicación
                                    </span>

                                    <span class="flex h-8 w-8 items-center justify-center rounded-full border border-slate-200 text-slate-500 transition duration-200 group-hover:border-primary-700 group-hover:bg-primary-700 group-hover:text-white">
                                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5"
                                             viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="1.8">
                                            <path d="M5 12h14M13 6l6 6-6 6"/>
                                        </svg>
                                    </span>
                                </div>
                            </a>

                        @endforeach
                    </div>

                    {{-- Paginación --}}
                    <div class="mt-12 border-t border-slate-200 pt-6">
                        {{ $items->withQueryString()->links() }}
                    </div>

                @endif

            </div>
        </div>
    </section>

</x-layouts.public>