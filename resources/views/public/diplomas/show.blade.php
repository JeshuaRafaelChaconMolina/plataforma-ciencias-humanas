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


                {{-- Plan Temático / Módulos --}}
                @if($diploma->modules->isNotEmpty())
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-xs space-y-6">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <div class="flex items-center gap-2 text-primary-800 font-bold text-lg">
                                <svg class="h-5 w-5 text-accent-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <h2>Estructura del Diplomado</h2>
                            </div>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                {{ $diploma->modules->count() }} {{ $diploma->modules->count() === 1 ? 'módulo' : 'módulos' }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            @foreach($diploma->modules as $index => $module)
                                <div class="flex items-start gap-4 rounded-xl border border-slate-100 bg-slate-50/70 p-4 transition hover:bg-white hover:shadow-xs">
                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-primary-700 text-xs font-bold text-white">
                                        {{ $index + 1 }}
                                    </span>
                                    <div class="flex-1">
                                        <h3 class="text-base font-bold text-slate-900">{{ $module->title }}</h3>
                                        @if($module->description)
                                            <p class="mt-1 text-sm text-slate-600 leading-relaxed">{{ $module->description }}</p>
                                        @endif
                                        @if($module->lessons->isNotEmpty())
                                            <ul class="mt-2 space-y-1 text-sm text-slate-600">
                                                @foreach($module->lessons as $lesson)
                                                    <li class="flex items-start gap-2">
                                                        <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-accent-500"></span>
                                                        <span>{{ $lesson->title }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

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
                        @if($diploma->duration)
                            <div class="flex items-center justify-between text-slate-600">
                                <span class="text-xs uppercase font-semibold text-slate-600">Duración</span>
                                <span class="font-bold text-slate-800">{{ $diploma->duration }}</span>
                            </div>
                        @endif
                        <div class="flex items-center justify-between text-slate-600">
                            <span class="text-xs uppercase font-semibold text-slate-600">Modalidad</span>
                            <span class="font-bold text-slate-800">{{ $diploma->modality ?? 'En línea / Híbrida' }}</span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span class="text-xs uppercase font-semibold text-slate-600">Plataforma</span>
                            <span class="font-bold text-primary-700">Moodle LMS</span>
                        </div>
                    </div>

                    {{-- Botón Moodle oficial institucional --}}
                    <div class="pt-2">
                        @if($diploma->moodleLink?->is_active && $diploma->moodleLink?->moodle_url)
                            <a href="{{ $diploma->moodleLink->moodle_url }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="flex w-full items-center justify-center gap-2 rounded-xl bg-accent-500 py-3.5 px-4 text-center text-sm font-extrabold text-primary-950 shadow-md transition hover:bg-accent-400 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-accent-400">
                                <span>INGRESAR AL DIPLOMADO</span>
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                </svg>
                            </a>
                            <p class="mt-2 text-center text-xs text-slate-600">
                                Serás redirigido al aula virtual de Moodle.
                            </p>
                        @else
                            <div class="rounded-xl bg-slate-50 border border-slate-200/80 p-4 text-center">
                                <p class="text-xs font-semibold text-slate-700">Enlace de acceso en configuración</p>
                                <p class="mt-0.5 text-[11px] text-slate-500">Pronto se habilitará el acceso directo a este programa en Moodle.</p>
                            </div>
                        @endif
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
