<x-layouts.public :title="$item->title">
    {{-- Breadcrumb --}}
    <div class="border-b border-slate-200/80 bg-white">
        <div class="mx-auto flex max-w-7xl items-center gap-2 px-4 py-3 text-xs text-slate-500 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="hover:text-primary-700">Inicio</a>
            <span>/</span>
            <a href="{{ route('websites.index') }}" class="hover:text-primary-700">Sitios Web</a>
            <span>/</span>
            <span class="truncate font-medium text-slate-800">{{ $item->title }}</span>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid items-start gap-10 lg:grid-cols-12">
            <article class="space-y-8 lg:col-span-8">
                <div>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-accent-500/15 px-3 py-1 text-xs font-bold text-primary-900">
                        <span class="h-1.5 w-1.5 rounded-full bg-accent-500"></span>
                        {{ $item->category?->name ?? 'Sitio Web de Interés' }}
                    </span>

                    <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">
                        {{ $item->title }}
                    </h1>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs space-y-4">
                    <div class="flex items-center gap-2 text-primary-800 font-bold text-lg">
                        <svg class="h-5 w-5 text-accent-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="8.5" /><path stroke-linecap="round" d="M3.5 12h17M12 3.5c2.5 2.5 2.5 15.5 0 17M12 3.5c-2.5 2.5-2.5 15.5 0 17" />
                        </svg>
                        <h2>Descripción del Recurso</h2>
                    </div>
                    <div class="text-base leading-relaxed text-slate-700 whitespace-pre-line">
                        {{ $item->description ?? 'Sin descripción adicional disponible.' }}
                    </div>
                </div>
            </article>

            <aside class="space-y-6 lg:col-span-4 lg:sticky lg:top-24">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-md space-y-5">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">
                        Acceso al Sitio Web
                    </h3>

                    @if($item->url)
                        <div>
                            <a href="{{ $item->url }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary-700 py-3.5 px-4 text-center text-sm font-bold text-white shadow-sm transition hover:bg-primary-800">
                                <span>Visitar sitio oficial</span>
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                </svg>
                            </a>
                            <p class="mt-2 text-center text-xs text-slate-500 break-all">
                                {{ $item->url }}
                            </p>
                        </div>
                    @endif

                    <div class="pt-4 border-t border-slate-100">
                        <a href="{{ route('websites.index') }}"
                           class="flex items-center justify-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-primary-700 transition">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            <span>Volver a sitios web</span>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.public>
