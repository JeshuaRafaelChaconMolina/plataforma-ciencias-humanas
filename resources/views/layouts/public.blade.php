<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }} — Ciencias Humanas</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|newsreader:400,400i,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50/70 font-sans text-slate-800 antialiased flex flex-col justify-between">

    {{-- Franja superior institucional (Azul profundo + Acento dorado) --}}
    <div class="h-1.5 w-full bg-gradient-to-r from-primary-800 via-primary-600 to-accent-500"></div>

    {{-- Barra de navegación principal --}}
    <header x-data="{ mobileOpen: false }" class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/95 backdrop-blur-md shadow-xs">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3.5 sm:px-6 lg:px-8">
            {{-- Logo / Identidad Institucional --}}
            <a href="{{ route('home') }}" class="group flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-primary-700 to-primary-900 text-white shadow-md shadow-primary-900/10 transition-transform duration-200 group-hover:scale-105">
                    <svg class="h-6 w-6 text-accent-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-primary-600">Portal Institucional</span>
                    <div class="flex items-center gap-1.5">
                        <span class="text-xl font-black tracking-tight text-slate-900 transition-colors group-hover:text-primary-700">Ciencias Humanas</span>
                        <span class="h-1.5 w-1.5 rounded-full bg-accent-500"></span>
                    </div>
                </div>
            </a>

            {{-- Menú público oficial de escritorio --}}
            <nav class="hidden items-center gap-1 text-sm font-medium text-slate-600 lg:flex">
                <a href="{{ route('library.index') }}"
                   @class([
                       'px-3.5 py-2 rounded-lg flex items-center gap-2 transition duration-150',
                       'bg-primary-50 text-primary-700 font-semibold shadow-xs border-b-2 border-accent-500' => request()->routeIs('library.*'),
                       'hover:bg-slate-100/80 hover:text-primary-700' => !request()->routeIs('library.*')
                   ])>
                    <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 19.5A2.5 2.5 0 0 0 6.5 22H20V2H6.5A2.5 2.5 0 0 0 4 4.5v15Z" />
                    </svg>
                    Biblioteca Virtual
                </a>

                <a href="{{ route('websites.index') }}"
                   @class([
                       'px-3.5 py-2 rounded-lg flex items-center gap-2 transition duration-150',
                       'bg-primary-50 text-primary-700 font-semibold shadow-xs border-b-2 border-accent-500' => request()->routeIs('websites.*'),
                       'hover:bg-slate-100/80 hover:text-primary-700' => !request()->routeIs('websites.*')
                   ])>
                    <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="12" r="8.5" /><path stroke-linecap="round" d="M3.5 12h17M12 3.5c2.5 2.5 2.5 15.5 0 17M12 3.5c-2.5 2.5-2.5 15.5 0 17" />
                    </svg>
                    Sitios Web
                </a>

                <div class="h-4 w-px bg-slate-200 mx-1"></div>

                <a href="{{ route('courses.index') }}"
                   @class([
                       'px-3.5 py-2 rounded-lg flex items-center gap-2 transition duration-150',
                       'bg-primary-50 text-primary-700 font-semibold shadow-xs border-b-2 border-accent-500' => request()->routeIs('courses.*'),
                       'hover:bg-slate-100/80 hover:text-primary-700' => !request()->routeIs('courses.*')
                   ])>
                    <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.5 9 9.5-4 9.5 4-9.5 4-9.5-4Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 11v4.5c0 1.2 2.7 2.5 6 2.5s6-1.3 6-2.5V11M20 9.5v5" />
                    </svg>
                    Cursos
                </a>

                <a href="{{ route('diplomas.index') }}"
                   @class([
                       'px-3.5 py-2 rounded-lg flex items-center gap-2 transition duration-150',
                       'bg-primary-50 text-primary-700 font-semibold shadow-xs border-b-2 border-accent-500' => request()->routeIs('diplomas.*'),
                       'hover:bg-slate-100/80 hover:text-primary-700' => !request()->routeIs('diplomas.*')
                   ])>
                    <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="9" r="5.5" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.5 13.5-1.5 7 5-2.5 5 2.5-1.5-7" />
                    </svg>
                    Diplomados
                </a>

                <a href="{{ route('workshops.index') }}"
                   @class([
                       'px-3.5 py-2 rounded-lg flex items-center gap-2 transition duration-150',
                       'bg-primary-50 text-primary-700 font-semibold shadow-xs border-b-2 border-accent-500' => request()->routeIs('workshops.*'),
                       'hover:bg-slate-100/80 hover:text-primary-700' => !request()->routeIs('workshops.*')
                   ])>
                    <svg class="h-4 w-4 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.5 6.5a4 4 0 0 0-5.4 4.9L4 16.5 6.5 19l5.1-5.1a4 4 0 0 0 4.9-5.4l-2.6 2.6-2-2 2.6-2.6Z" />
                    </svg>
                    Talleres
                </a>
            </nav>

            {{-- Acceso a cuenta / Panel --}}
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard.index') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                        <span>Mi panel</span>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center gap-1.5 rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-primary-800 shadow-2xs transition hover:border-primary-400 hover:bg-primary-50/50">
                        <svg class="h-4 w-4 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                        <span>Iniciar sesión</span>
                    </a>
                @endauth

                {{-- Botón Móvil --}}
                <button @click="mobileOpen = !mobileOpen"
                        type="button"
                        class="inline-flex items-center justify-center rounded-xl p-2 text-slate-600 hover:bg-slate-100 hover:text-primary-700 lg:hidden focus:outline-none"
                        aria-label="Abrir menú">
                    <svg x-show="!mobileOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Menú móvil desplegable fluido con Alpine.js --}}
        <div x-show="mobileOpen"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="border-b border-slate-200 bg-white/98 px-4 pb-6 pt-2 lg:hidden shadow-lg">
            <nav class="flex flex-col gap-1 text-base font-medium">
                <a href="{{ route('library.index') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2.5 hover:bg-slate-50 text-slate-700">
                    <svg class="h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 19.5A2.5 2.5 0 0 0 6.5 22H20V2H6.5A2.5 2.5 0 0 0 4 4.5v15Z" /></svg>
                    Biblioteca Virtual
                </a>
                <a href="{{ route('websites.index') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2.5 hover:bg-slate-50 text-slate-700">
                    <svg class="h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="8.5" /><path stroke-linecap="round" d="M3.5 12h17M12 3.5c2.5 2.5 2.5 15.5 0 17M12 3.5c-2.5 2.5-2.5 15.5 0 17" /></svg>
                    Sitios Web
                </a>
                <a href="{{ route('courses.index') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2.5 hover:bg-slate-50 text-slate-700">
                    <svg class="h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m2.5 9 9.5-4 9.5 4-9.5 4-9.5-4Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 11v4.5c0 1.2 2.7 2.5 6 2.5s6-1.3 6-2.5V11M20 9.5v5" /></svg>
                    Cursos
                </a>
                <a href="{{ route('diplomas.index') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2.5 hover:bg-slate-50 text-slate-700">
                    <svg class="h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="9" r="5.5" /><path stroke-linecap="round" stroke-linejoin="round" d="m8.5 13.5-1.5 7 5-2.5 5 2.5-1.5-7" /></svg>
                    Diplomados
                </a>
                <a href="{{ route('workshops.index') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2.5 hover:bg-slate-50 text-slate-700">
                    <svg class="h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.5 6.5a4 4 0 0 0-5.4 4.9L4 16.5 6.5 19l5.1-5.1a4 4 0 0 0 4.9-5.4l-2.6 2.6-2-2 2.6-2.6Z" /></svg>
                    Talleres
                </a>
            </nav>
        </div>
    </header>

    {{-- Contenido principal --}}
    <main class="flex-1">
        {{ $slot }}
    </main>

    {{-- Pie de página institucional enriquecido --}}
    <footer class="mt-24 border-t border-slate-200/90 bg-slate-900 text-slate-400">
        {{-- Franja de color superior del footer --}}
        <div class="h-1 w-full bg-gradient-to-r from-primary-600 via-accent-500 to-primary-700"></div>

        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                {{-- Columna 1: Identidad y propósito --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-2 text-white">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary-700 text-white shadow-sm">
                            <svg class="h-5 w-5 text-accent-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <span class="text-lg font-bold tracking-tight">Ciencias Humanas</span>
                    </div>
                    <div class="h-1 w-12 rounded-full bg-accent-500"></div>
                    <p class="text-sm leading-relaxed text-slate-300">
                        Plataforma universitaria para la difusión de conocimiento científico, pensamiento crítico, recursos bibliográficos y oferta educativa continua.
                    </p>
                </div>

                {{-- Columna 2: Oferta Educativa --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-accent-400">Oferta Educativa</h3>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        <li>
                            <a href="{{ route('courses.index') }}" class="transition hover:text-white hover:underline">Cursos en línea y presenciales</a>
                        </li>
                        <li>
                            <a href="{{ route('diplomas.index') }}" class="transition hover:text-white hover:underline">Diplomados de especialización</a>
                        </li>
                        <li>
                            <a href="{{ route('workshops.index') }}" class="transition hover:text-white hover:underline">Talleres prácticos</a>
                        </li>
                        <li class="pt-2 text-xs text-slate-500">
                            Aulas virtuales vinculadas con Moodle LMS.
                        </li>
                    </ul>
                </div>

                {{-- Columna 3: Biblioteca Virtual --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-accent-400">Biblioteca Virtual</h3>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        <li>
                            <a href="{{ route('library.index') }}?tipo=articulos" class="transition hover:text-white hover:underline">Artículos de investigación</a>
                        </li>
                        <li>
                            <a href="{{ route('library.index') }}?tipo=libros" class="transition hover:text-white hover:underline">Libros y publicaciones</a>
                        </li>
                        <li>
                            <a href="{{ route('library.index') }}?tipo=revistas" class="transition hover:text-white hover:underline">Revistas científicas</a>
                        </li>
                        <li>
                            <a href="{{ route('websites.index') }}" class="transition hover:text-white hover:underline">Sitios web recomendados</a>
                        </li>
                    </ul>
                </div>

                {{-- Columna 4: Accesos y Privacidad --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-accent-400">Comunidad & Legal</h3>
                    <ul class="mt-4 space-y-2.5 text-sm">
                        @auth
                            <li>
                                <a href="{{ route('dashboard.index') }}" class="text-white font-medium hover:underline flex items-center gap-1.5">
                                    <span>Ir a mi panel</span>
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="transition hover:text-white hover:underline">Acceso a docentes y alumnos</a>
                            </li>
                        @endauth
                        <li>
                            <a href="{{ route('privacy.index') }}" class="transition hover:text-white hover:underline">Aviso de Privacidad</a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Pie inferior --}}
            <div class="mt-12 border-t border-slate-800/80 pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-4">
                <p>&copy; {{ date('Y') }} Plataforma Ciencias Humanas. Todos los derechos reservados.</p>
                <div class="flex items-center gap-2">
                    <span class="inline-block h-2 w-2 rounded-full bg-accent-500"></span>
                    <span>Educación e Investigación de Calidad</span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
