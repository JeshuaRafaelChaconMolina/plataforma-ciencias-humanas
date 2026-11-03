<x-layouts.app :title="'Mi panel de Docente'">
    <div class="space-y-8">
        {{-- Banner del Docente --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-primary-900 via-primary-800 to-primary-950 p-6 sm:p-8 text-white shadow-lg">
            <div class="pointer-events-none absolute -right-10 -bottom-10 h-60 w-60 rounded-full bg-accent-500/15 blur-3xl"></div>

            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-accent-300 mb-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-accent-400"></span>
                        <span>Espacio Docente</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                        Bienvenido, {{ auth()->user()->name }}
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-primary-100 max-w-xl">
                        Panel académico para profesores y facilitadores de la Facultad de Ciencias Humanas.
                    </p>
                </div>

                <div class="shrink-0">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center gap-1.5 rounded-xl bg-accent-500 px-4 py-2.5 text-xs font-bold text-primary-950 shadow-sm transition hover:bg-accent-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                        <span>Ver portal institucional</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Tarjetas de información y estado institucional --}}
        <div class="grid gap-6 sm:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xs space-y-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-50 text-primary-700">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Aulas Virtuales y Moodle</h3>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">
                    La asignación y vinculación de tus cursos se gestiona en conjunto con la administración del portal. Al ingresar a tus cursos desde la plataforma serás redirigido con tus credenciales activas.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xs space-y-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-accent-50 text-accent-700">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">Biblioteca y Repositorio</h3>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Puedes consultar todos los artículos, libros y revistas publicados por investigadores y colegas en la Biblioteca Virtual para incorporarlos como material de consulta en tus cursos.
                </p>
            </div>
        </div>
    </div>
</x-layouts.app>
