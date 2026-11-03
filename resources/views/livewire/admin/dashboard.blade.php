<div class="space-y-8">
    {{-- Banner de bienvenida del Administrador --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-primary-900 via-primary-800 to-primary-950 p-6 sm:p-8 text-white shadow-lg">
        <div class="pointer-events-none absolute -right-10 -bottom-10 h-60 w-60 rounded-full bg-accent-500/15 blur-3xl"></div>

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-accent-300 mb-2">
                    <span class="h-1.5 w-1.5 rounded-full bg-accent-400"></span>
                    <span>Panel de Administración Central</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Bienvenido, {{ auth()->user()->name }}
                </h1>
                <p class="mt-1 text-xs sm:text-sm text-primary-100 max-w-xl">
                    Monitorea los recursos del repositorio académico, gestiona la oferta educativa y supervisa los usuarios de la plataforma.
                </p>
            </div>

            <div class="shrink-0 flex items-center gap-2">
                <a href="{{ route('admin.courses.create') }}"
                   class="inline-flex items-center gap-1.5 rounded-xl bg-accent-500 px-4 py-2.5 text-xs font-bold text-primary-950 shadow-sm transition hover:bg-accent-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Nuevo Curso</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Métricas del sistema en tarjetas de alta calidad --}}
    <div>
        <div class="flex items-center justify-between pb-4 border-b border-slate-200">
            <h2 class="text-base font-bold text-slate-800">Resumen Estadístico</h2>
            <span class="text-xs text-slate-500">Métricas en tiempo real</span>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($metrics as $label => $value)
                @php
                    $cleanLabel = str_replace(['total_', '_'], ['', ' '], $label);
                    $iconColor = match(true) {
                        str_contains($label, 'usuarios') => 'text-blue-600 bg-blue-50',
                        str_contains($label, 'cursos') => 'text-indigo-600 bg-indigo-50',
                        str_contains($label, 'diplomados') => 'text-amber-600 bg-amber-50',
                        str_contains($label, 'talleres') => 'text-emerald-600 bg-emerald-50',
                        str_contains($label, 'articulos') => 'text-purple-600 bg-purple-50',
                        str_contains($label, 'libros') => 'text-rose-600 bg-rose-50',
                        default => 'text-primary-600 bg-primary-50',
                    };
                @endphp

                <div class="group relative overflow-hidden rounded-2xl border border-slate-200/90 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-primary-300 hover:shadow-md">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-500">
                            {{ ucfirst($cleanLabel) }}
                        </span>
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl {{ $iconColor }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.143 2.143L15.429 6" />
                            </svg>
                        </div>
                    </div>

                    <div class="mt-4 flex items-baseline gap-2">
                        <span class="text-3xl font-black text-slate-900 group-hover:text-primary-700 transition-colors">
                            {{ $value }}
                        </span>
                        <span class="text-xs text-slate-400">registros</span>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                        <span>Activos en plataforma</span>
                        <span class="h-1.5 w-1.5 rounded-full bg-accent-500"></span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Accesos Rápidos de Creación --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 border-b border-slate-100 pb-3">
            Acciones Rápidas de Creación
        </h3>

        <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-4">
            <a href="{{ route('admin.courses.create') }}"
               class="flex items-center gap-2.5 rounded-xl border border-slate-200 p-3 text-xs font-semibold text-slate-700 hover:border-primary-400 hover:bg-primary-50 hover:text-primary-700 transition">
                <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary-100 text-primary-700 font-bold">+</span>
                <span>Crear Curso</span>
            </a>

            <a href="{{ route('admin.articles.create') }}"
               class="flex items-center gap-2.5 rounded-xl border border-slate-200 p-3 text-xs font-semibold text-slate-700 hover:border-primary-400 hover:bg-primary-50 hover:text-primary-700 transition">
                <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary-100 text-primary-700 font-bold">+</span>
                <span>Subir Artículo</span>
            </a>

            <a href="{{ route('admin.books.create') }}"
               class="flex items-center gap-2.5 rounded-xl border border-slate-200 p-3 text-xs font-semibold text-slate-700 hover:border-primary-400 hover:bg-primary-50 hover:text-primary-700 transition">
                <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary-100 text-primary-700 font-bold">+</span>
                <span>Registrar Libro</span>
            </a>

            <a href="{{ route('admin.categories.create') }}"
               class="flex items-center gap-2.5 rounded-xl border border-slate-200 p-3 text-xs font-semibold text-slate-700 hover:border-primary-400 hover:bg-primary-50 hover:text-primary-700 transition">
                <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary-100 text-primary-700 font-bold">+</span>
                <span>Nueva Categoría</span>
            </a>
        </div>
    </div>
</div>