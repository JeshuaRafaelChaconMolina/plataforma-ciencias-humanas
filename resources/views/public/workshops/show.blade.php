<x-layouts.public :title="$workshop->title">
    {{-- Breadcrumb --}}
    <div class="border-b border-slate-200/80 bg-white">
        <div class="mx-auto flex max-w-7xl items-center gap-2 px-4 py-3 text-xs text-slate-500 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="hover:text-primary-700">Inicio</a>
            <span>/</span>
            <a href="{{ route('workshops.index') }}" class="hover:text-primary-700">Talleres</a>
            <span>/</span>
            <span class="truncate font-medium text-slate-800">{{ $workshop->title }}</span>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid items-start gap-10 lg:grid-cols-12">
            <article class="space-y-8 lg:col-span-8">
                <div>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-accent-500/15 px-3 py-1 text-xs font-bold text-primary-900">
                        <span class="h-1.5 w-1.5 rounded-full bg-accent-500"></span>
                        Taller Práctico
                    </span>

                    <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">
                        {{ $workshop->title }}
                    </h1>
                </div>

                @if($workshop->image)
                    <div class="overflow-hidden rounded-2xl border border-slate-200 shadow-sm">
                        <img src="{{ asset('storage/' . $workshop->image) }}"
                             alt="{{ $workshop->title }}"
                             class="h-72 sm:h-96 w-full object-cover">
                    </div>
                @endif

                <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs space-y-4">
                    <div class="flex items-center gap-2 text-primary-800 font-bold text-lg">
                        <svg class="h-5 w-5 text-accent-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.5 6.5a4 4 0 0 0-5.4 4.9L4 16.5 6.5 19l5.1-5.1a4 4 0 0 0 4.9-5.4l-2.6 2.6-2-2 2.6-2.6Z" />
                        </svg>
                        <h2>Descripción y Metodología</h2>
                    </div>
                    <div class="text-base leading-relaxed text-slate-700 whitespace-pre-line">
                        {{ $workshop->purpose ?? $workshop->description ?? 'Sin descripción disponible por el momento.' }}
                    </div>
                </div>
            </article>

            <aside class="space-y-6 lg:col-span-4 lg:sticky lg:top-24">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-md space-y-5">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">
                        Ficha del Taller
                    </h3>

                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between text-slate-600">
                            <span class="text-xs uppercase font-semibold text-slate-600">Modalidad</span>
                            <span class="font-bold text-slate-800">Práctica / Taller</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span class="text-xs uppercase font-semibold text-slate-600">Área</span>
                            <span class="font-bold text-slate-800">Ciencias Humanas</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <a href="{{ route('workshops.index') }}"
                           class="flex items-center justify-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-primary-700 transition">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            <span>Volver al catálogo de talleres</span>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.public>
