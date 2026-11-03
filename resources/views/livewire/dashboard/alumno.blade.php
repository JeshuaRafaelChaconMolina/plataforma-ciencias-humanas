<x-layouts.app :title="'Mi panel de Alumno'">
    <div class="space-y-10">
        {{-- Banner de bienvenida del Alumno --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-primary-900 via-primary-800 to-primary-950 p-6 sm:p-8 text-white shadow-lg">
            <div class="pointer-events-none absolute -right-10 -bottom-10 h-60 w-60 rounded-full bg-accent-500/15 blur-3xl"></div>

            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-accent-300 mb-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-accent-400"></span>
                        <span>Portal del Estudiante</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                        Hola, {{ auth()->user()->name }}
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-primary-100 max-w-xl">
                        Explora el catálogo de cursos, diplomados y talleres disponibles para tu formación continua.
                    </p>
                </div>

                <div class="shrink-0">
                    <a href="{{ route('courses.index') }}"
                       class="inline-flex items-center gap-1.5 rounded-xl bg-accent-500 px-4 py-2.5 text-xs font-bold text-primary-950 shadow-sm transition hover:bg-accent-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <span>Explorar catálogo completo</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Cursos disponibles --}}
        <div>
            <div class="flex items-center justify-between pb-4 border-b border-slate-200">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Cursos recomendados</h2>
                    <p class="text-xs text-slate-500">Programas de formación activa con acceso a Moodle</p>
                </div>
                <a href="{{ route('courses.index') }}" class="text-xs font-bold text-primary-700 hover:underline">Ver todos &rarr;</a>
            </div>

            <div class="mt-6">
                @if($cursos->isEmpty())
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-8 text-center text-sm text-slate-500">
                        Aún no hay cursos publicados en este ciclo.
                    </div>
                @else
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($cursos as $curso)
                            <x-card :title="$curso->title"
                                    :href="route('courses.show', $curso)"
                                    :category="$curso->category?->name ?? 'Curso'"
                                    :image="$curso->image"
                                    actionText="Ver curso">
                                {{ Str::limit($curso->purpose ?? $curso->description, 90) }}
                            </x-card>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- Diplomados disponibles --}}
        <div>
            <div class="flex items-center justify-between pb-4 border-b border-slate-200">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Diplomados de especialización</h2>
                    <p class="text-xs text-slate-500">Programas modulares avanzados</p>
                </div>
                <a href="{{ route('diplomas.index') }}" class="text-xs font-bold text-primary-700 hover:underline">Ver todos &rarr;</a>
            </div>

            <div class="mt-6">
                @if($diplomados->isEmpty())
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-8 text-center text-sm text-slate-500">
                        Aún no hay diplomados publicados.
                    </div>
                @else
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($diplomados as $diplomado)
                            <x-card :title="$diplomado->title"
                                    :href="route('diplomas.show', $diplomado)"
                                    category="Diplomado"
                                    :image="$diplomado->image"
                                    actionText="Ver diplomado">
                                {{ Str::limit($diplomado->purpose ?? $diplomado->description, 90) }}
                            </x-card>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- Talleres prácticos --}}
        <div>
            <div class="flex items-center justify-between pb-4 border-b border-slate-200">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Talleres prácticos</h2>
                    <p class="text-xs text-slate-500">Sesiones dinámicas de aprendizaje</p>
                </div>
                <a href="{{ route('workshops.index') }}" class="text-xs font-bold text-primary-700 hover:underline">Ver todos &rarr;</a>
            </div>

            <div class="mt-6">
                @if($talleres->isEmpty())
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-8 text-center text-sm text-slate-500">
                        Aún no hay talleres publicados.
                    </div>
                @else
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($talleres as $taller)
                            <x-card :title="$taller->title"
                                    :href="route('workshops.show', $taller)"
                                    category="Taller"
                                    :image="$taller->image"
                                    actionText="Ver taller">
                                {{ Str::limit($taller->purpose ?? $taller->description, 90) }}
                            </x-card>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
