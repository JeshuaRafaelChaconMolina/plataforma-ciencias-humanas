<x-layouts.public :title="$diploma->title">
    {{-- Breadcrumb --}}
    <div class="border-b border-slate-200/80 bg-white">
        <div class="mx-auto flex max-w-7xl items-center gap-2 px-4 py-3 text-xs text-slate-500 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="hover:text-primary-700">Inicio</a>
            <span>/</span>
            <a href="{{ route('diplomas.index') }}" class="hover:text-primary-700">Diplomados</a>
            <span>/</span>
            <span class="truncate font-medium text-slate-800">{{ $diploma->title }}</span>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid items-start gap-10 lg:grid-cols-12">
            <article class="space-y-8 lg:col-span-8">
                <div>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-accent-500/15 px-3 py-1 text-xs font-bold text-primary-900">
                        <span class="h-1.5 w-1.5 rounded-full bg-accent-500"></span>
                        Diplomado Institucional
                    </span>

                    <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">
                        {{ $diploma->title }}
                    </h1>
                </div>

                @if($diploma->image)
                    <div class="overflow-hidden rounded-2xl border border-slate-200 shadow-sm">
                        <img src="{{ asset('storage/' . $diploma->image) }}"
                             alt="{{ $diploma->title }}"
                             class="h-72 sm:h-96 w-full object-cover">
                    </div>
                @endif

                <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs space-y-4">
                    <div class="flex items-center gap-2 text-primary-800 font-bold text-lg">
                        <svg class="h-5 w-5 text-accent-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                        <h2>Propósito y Alcance</h2>
                    </div>
                    <div class="text-base leading-relaxed text-slate-700 whitespace-pre-line">
                        {{ $diploma->purpose ?? $diploma->description ?? 'Sin descripción disponible por el momento.' }}
                    </div>
                </div>

                {{-- Cursos que lo integran --}}
                @if($diploma->courses->isNotEmpty())
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs space-y-4">
                        <div class="flex items-center gap-2 text-primary-800 font-bold text-lg border-b border-slate-100 pb-3">
                            <svg class="h-5 w-5 text-accent-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.5 9 9.5-4 9.5 4-9.5 4-9.5-4Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 11v4.5c0 1.2 2.7 2.5 6 2.5s6-1.3 6-2.5V11M20 9.5v5" />
                            </svg>
                            <h2>Cursos que Integran este Diplomado</h2>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">
                            @foreach($diploma->courses as $course)
                                <a href="{{ route('courses.show', $course) }}"
                                   class="group flex items-center justify-between rounded-xl border border-slate-200/90 bg-slate-50/70 p-4 transition hover:border-primary-300 hover:bg-white hover:shadow-sm">
                                    <span class="text-sm font-bold text-slate-800 group-hover:text-primary-700">
                                        {{ $course->title }}
                                    </span>
                                    <svg class="h-4 w-4 text-slate-400 group-hover:text-primary-700 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </article>

            <aside class="space-y-6 lg:col-span-4 lg:sticky lg:top-24">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-md space-y-5">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">
                        Información General
                    </h3>

                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between text-slate-600">
                            <span class="text-xs uppercase font-semibold text-slate-600">Programa</span>
                            <span class="font-bold text-slate-800">Diplomado</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span class="text-xs uppercase font-semibold text-slate-600">Total de cursos</span>
                            <span class="font-bold text-primary-700">{{ $diploma->courses->count() }}</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <a href="{{ route('diplomas.index') }}"
                           class="flex items-center justify-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-primary-700 transition">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            <span>Volver a diplomados</span>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.public>
