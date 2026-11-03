<x-layouts.public :title="$item->title">
    {{-- Migas de pan / Breadcrumbs --}}
    <div class="border-b border-slate-200/80 bg-white">
        <div class="mx-auto flex max-w-7xl items-center gap-2 px-4 py-3 text-xs text-slate-500 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="hover:text-primary-700">Inicio</a>
            <span>/</span>
            <a href="{{ route('library.index') }}?tipo=libros" class="hover:text-primary-700">Biblioteca Virtual</a>
            <span>/</span>
            <span class="truncate font-medium text-slate-800">{{ $item->title }}</span>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid items-start gap-10 lg:grid-cols-12">
            {{-- Columna de lectura del libro (8 cols) --}}
            <article class="space-y-8 lg:col-span-8">
                <div>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-accent-500/15 px-3 py-1 text-xs font-bold text-primary-900">
                        <span class="h-1.5 w-1.5 rounded-full bg-accent-500"></span>
                        Libro • {{ $item->category?->name ?? 'General' }}
                    </span>

                    <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">
                        {{ $item->title }}
                    </h1>

                    @if($item->published_at)
                        <p class="mt-3 text-xs font-medium text-slate-500">
                            Publicado el {{ $item->published_at->isoFormat('D [de] MMMM [de] YYYY') }}
                        </p>
                    @endif
                </div>

                {{-- Resumen / Sinopsis --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs space-y-4">
                    <div class="flex items-center gap-2 text-primary-800 font-bold text-lg border-b border-slate-100 pb-3">
                        <svg class="h-5 w-5 text-accent-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                        <h2>Sinopsis y Contenido</h2>
                    </div>

                    <div class="text-base leading-relaxed text-slate-700 whitespace-pre-line">
                        {{ $item->description ?? 'Sin sinopsis disponible.' }}
                    </div>
                </div>
            </article>

            {{-- Columna lateral / Descarga y ficha --}}
            <aside class="space-y-6 lg:col-span-4 lg:sticky lg:top-24">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-md space-y-6">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">
                        Publicación y Descarga
                    </h3>

                    @php($file = $item->files()->latest()->first())
                    @if($file)
                        <div class="rounded-xl border border-primary-100 bg-primary-50/50 p-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-primary-700 text-white shadow-xs">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-xs font-bold text-slate-900">{{ $file->original_name ?? 'Libro completo' }}</p>
                                    <p class="text-[11px] text-slate-500">Documento en acceso abierto</p>
                                </div>
                            </div>

                            <a href="{{ asset('storage/' . $file->path) }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="mt-4 flex w-full items-center justify-center gap-2 rounded-xl bg-primary-700 py-3 px-4 text-center text-xs font-bold text-white shadow-sm transition hover:bg-primary-800">
                                <span>Descargar libro digital</span>
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                            </a>
                        </div>
                    @else
                        <div class="rounded-xl bg-slate-50 border border-slate-200/80 p-4 text-center">
                            <p class="text-xs text-slate-500">Esta publicación no cuenta con archivo digital disponible para descarga directa.</p>
                        </div>
                    @endif

                    <div class="pt-2 border-t border-slate-100">
                        <a href="{{ route('library.index') }}?tipo=libros"
                           class="flex items-center justify-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-primary-700 transition">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            <span>Volver a la Biblioteca Virtual</span>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.public>
