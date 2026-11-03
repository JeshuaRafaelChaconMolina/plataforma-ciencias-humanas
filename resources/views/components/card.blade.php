@props([
    'title',
    'href' => null,
    'category' => null,
    'image' => null,
    'actionText' => 'Ver detalle',
])

<div class="group relative flex flex-col overflow-hidden rounded-2xl border border-slate-200/80 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:border-primary-200 hover:shadow-xl">
    {{-- Contenedor de Imagen o Placeholder decorativo --}}
    <div class="relative h-48 w-full overflow-hidden bg-gradient-to-br from-primary-900 via-primary-800 to-primary-700">
        @if($image)
            <img src="{{ asset('storage/' . $image) }}"
                 alt="{{ $title }}"
                 class="h-full w-full object-cover transition-transform duration-500 ease-out group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
        @else
            {{-- Placeholder académico cuando no hay imagen cargada --}}
            <div class="flex h-full w-full items-center justify-center p-6 text-center">
                <div class="absolute inset-0 opacity-10">
                    <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <defs>
                            <pattern id="grid-pattern-{{ md5($title) }}" width="10" height="10" patternUnits="userSpaceOnUse">
                                <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5" />
                            </pattern>
                        </defs>
                        <rect width="100" height="100" fill="url(#grid-pattern-{{ md5($title) }})" />
                    </svg>
                </div>
                <div class="relative flex flex-col items-center">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 text-accent-400 backdrop-blur-sm transition-transform duration-300 group-hover:scale-110">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                </div>
            </div>
        @endif

        {{-- Badge de categoría flotante con estilo institucional --}}
        @if($category)
            <div class="absolute left-4 top-4 z-10">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-white/95 px-3 py-1 text-xs font-semibold text-primary-900 shadow-sm backdrop-blur">
                    <span class="h-1.5 w-1.5 rounded-full bg-accent-500"></span>
                    {{ $category }}
                </span>
            </div>
        @endif
    </div>

    {{-- Contenido de la tarjeta --}}
    <div class="flex flex-1 flex-col justify-between p-6">
        <div>
            <h3 class="line-clamp-2 text-lg font-bold tracking-tight text-slate-900 transition-colors duration-200 group-hover:text-primary-700">
                {{ $title }}
            </h3>

            <div class="mt-3 line-clamp-3 text-sm leading-relaxed text-slate-600">
                {{ $slot }}
            </div>
        </div>

        {{-- Botón de acción con microinteracción --}}
        @if($href)
            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ $href }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold text-primary-700 transition hover:text-primary-800">
                    <span>{{ $actionText }}</span>
                    <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <span class="h-2 w-2 rounded-full bg-accent-400 opacity-0 transition-opacity group-hover:opacity-100"></span>
            </div>
        @endif
    </div>
</div>