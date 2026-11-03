<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-50 scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Panel de Control' }} — Ciencias Humanas</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full font-sans text-slate-800 antialiased" x-data="{ sidebarOpen: false }">

    {{-- Franja superior de acento --}}
    <div class="h-1.5 w-full bg-gradient-to-r from-primary-800 via-primary-600 to-accent-500 fixed top-0 left-0 right-0 z-50"></div>

    <div class="flex min-h-full pt-1.5">

        {{-- Backdrop para móviles --}}
        <div x-show="sidebarOpen"
             x-cloak
             @click="sidebarOpen = false"
             class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-xs lg:hidden"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        {{-- SIDEBAR LATERAL --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col bg-slate-950 text-white shadow-2xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 lg:shadow-none">

            {{-- Encabezado del Sidebar --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-white/10">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-700 text-white shadow-md shadow-primary-700/30 transition-transform duration-200 group-hover:scale-105">
                        <svg class="h-5 w-5 text-accent-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-primary-400 block">Plataforma</span>
                        <span class="text-base font-black tracking-tight text-white">Ciencias Humanas</span>
                    </div>
                </a>

                {{-- Cerrar en móvil --}}
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Navegación con permisos y roles --}}
            <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5 text-sm">

                @if(auth()->user()->isDocente())
                    <a href="{{ route('dashboard.index') }}"
                       @class([
                           'flex items-center gap-3 rounded-xl px-3.5 py-2.5 transition duration-150',
                           'bg-primary-700 text-white font-semibold shadow-sm' => request()->routeIs('dashboard.*'),
                           'text-slate-300 hover:bg-white/5 hover:text-white' => !request()->routeIs('dashboard.*')
                       ])>
                        <svg class="h-5 w-5 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 4l9 6.5M5 9.5V19a1 1 0 0 0 1 1h4v-5h4v5h4a1 1 0 0 0 1-1V9.5" />
                        </svg>
                        <span>Mi resumen docente</span>
                    </a>
                @endif

                @can('ver_usuarios')
                    <a href="{{ route('admin.dashboard') }}"
                       @class([
                           'flex items-center gap-3 rounded-xl px-3.5 py-2.5 transition duration-150',
                           'bg-primary-700 text-white font-semibold shadow-sm' => request()->routeIs('admin.dashboard'),
                           'text-slate-300 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.dashboard')
                       ])>
                        <svg class="h-5 w-5 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 4l9 6.5M5 9.5V19a1 1 0 0 0 1 1h4v-5h4v5h4a1 1 0 0 0 1-1V9.5" />
                        </svg>
                        <span>Inicio / Dashboard</span>
                    </a>

                    <div class="pt-4 pb-1">
                        <p class="px-3.5 text-[11px] font-bold uppercase tracking-wider text-accent-400">Administración</p>
                    </div>

                    <a href="{{ route('admin.users.index') }}"
                       @class([
                           'flex items-center gap-3 rounded-xl px-3.5 py-2.5 transition duration-150',
                           'bg-primary-700 text-white font-semibold shadow-sm' => request()->routeIs('admin.users.*'),
                           'text-slate-300 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.users.*')
                       ])>
                        <svg class="h-5 w-5 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <circle cx="9" cy="8" r="3" /><path stroke-linecap="round" stroke-linejoin="round" d="M3.5 20a5.5 5.5 0 0 1 11 0" /><circle cx="17" cy="9" r="2.3" /><path stroke-linecap="round" stroke-linejoin="round" d="M14.8 20a4.3 4.3 0 0 1 6.7-3.6" />
                        </svg>
                        <span>Usuarios y Roles</span>
                    </a>

                    <a href="{{ route('admin.categories.index') }}"
                       @class([
                           'flex items-center gap-3 rounded-xl px-3.5 py-2.5 transition duration-150',
                           'bg-primary-700 text-white font-semibold shadow-sm' => request()->routeIs('admin.categories.*'),
                           'text-slate-300 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.categories.*')
                       ])>
                        <svg class="h-5 w-5 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h7l9 9-7 7-9-9V4Z" /><circle cx="8.5" cy="8.5" r="1.2" fill="currentColor" stroke="none" />
                        </svg>
                        <span>Categorías</span>
                    </a>
                @endcan

                @canany(['ver_articulos', 'ver_libros', 'ver_revistas', 'ver_sitios_web'])
                    <div class="pt-5 pb-1">
                        <p class="px-3.5 text-[11px] font-bold uppercase tracking-wider text-accent-400">Repositorio Digital</p>
                    </div>

                    @can('ver_articulos')
                        <a href="{{ route('admin.articles.index') }}"
                           @class([
                               'flex items-center gap-3 rounded-xl px-3.5 py-2.5 transition duration-150',
                               'bg-primary-700 text-white font-semibold shadow-sm' => request()->routeIs('admin.articles.*'),
                               'text-slate-300 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.articles.*')
                           ])>
                            <svg class="h-5 w-5 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l4 4v14a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z" /><path stroke-linecap="round" d="M9 12h6M9 16h6M9 8h3" />
                            </svg>
                            <span>Artículos</span>
                        </a>
                    @endcan

                    @can('ver_libros')
                        <a href="{{ route('admin.books.index') }}"
                           @class([
                               'flex items-center gap-3 rounded-xl px-3.5 py-2.5 transition duration-150',
                               'bg-primary-700 text-white font-semibold shadow-sm' => request()->routeIs('admin.books.*'),
                               'text-slate-300 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.books.*')
                           ])>
                            <svg class="h-5 w-5 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6c-1.8-1.2-4-1.8-6.5-1.8V17c2.5 0 4.7.6 6.5 1.8m0-12.8c1.8-1.2 4-1.8 6.5-1.8V17c-2.5 0-4.7.6-6.5 1.8m0-12.8V18.8" />
                            </svg>
                            <span>Libros</span>
                        </a>
                    @endcan

                    @can('ver_revistas')
                        <a href="{{ route('admin.journals.index') }}"
                           @class([
                               'flex items-center gap-3 rounded-xl px-3.5 py-2.5 transition duration-150',
                               'bg-primary-700 text-white font-semibold shadow-sm' => request()->routeIs('admin.journals.*'),
                               'text-slate-300 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.journals.*')
                           ])>
                            <svg class="h-5 w-5 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 5h12v14H6a2 2 0 0 1-2-2V5Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16 8h4v9a2 2 0 0 1-2 2h-2" /><path stroke-linecap="round" d="M7 9h6M7 12h6M7 15h4" />
                            </svg>
                            <span>Revistas</span>
                        </a>
                    @endcan

                    @can('ver_sitios_web')
                        <a href="{{ route('admin.websites.index') }}"
                           @class([
                               'flex items-center gap-3 rounded-xl px-3.5 py-2.5 transition duration-150',
                               'bg-primary-700 text-white font-semibold shadow-sm' => request()->routeIs('admin.websites.*'),
                               'text-slate-300 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.websites.*')
                           ])>
                            <svg class="h-5 w-5 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="12" r="8.5" /><path stroke-linecap="round" d="M3.5 12h17M12 3.5c2.5 2.5 2.5 15.5 0 17M12 3.5c-2.5 2.5-2.5 15.5 0 17" />
                            </svg>
                            <span>Sitios Web</span>
                        </a>
                    @endcan
                @endcanany

                @canany(['ver_cursos', 'ver_diplomados', 'ver_talleres'])
                    <div class="pt-5 pb-1">
                        <p class="px-3.5 text-[11px] font-bold uppercase tracking-wider text-accent-400">Oferta Educativa</p>
                    </div>

                    @can('ver_cursos')
                        <a href="{{ route('admin.courses.index') }}"
                           @class([
                               'flex items-center gap-3 rounded-xl px-3.5 py-2.5 transition duration-150',
                               'bg-primary-700 text-white font-semibold shadow-sm' => request()->routeIs('admin.courses.*'),
                               'text-slate-300 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.courses.*')
                           ])>
                            <svg class="h-5 w-5 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.5 9 9.5-4 9.5 4-9.5 4-9.5-4Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 11v4.5c0 1.2 2.7 2.5 6 2.5s6-1.3 6-2.5V11M20 9.5v5" />
                            </svg>
                            <span>Cursos</span>
                        </a>
                    @endcan

                    @can('ver_diplomados')
                        <a href="{{ route('admin.diplomas.index') }}"
                           @class([
                               'flex items-center gap-3 rounded-xl px-3.5 py-2.5 transition duration-150',
                               'bg-primary-700 text-white font-semibold shadow-sm' => request()->routeIs('admin.diplomas.*'),
                               'text-slate-300 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.diplomas.*')
                           ])>
                            <svg class="h-5 w-5 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="9" r="5.5" /><path stroke-linecap="round" stroke-linejoin="round" d="m8.5 13.5-1.5 7 5-2.5 5 2.5-1.5-7" />
                            </svg>
                            <span>Diplomados</span>
                        </a>
                    @endcan

                    @can('ver_talleres')
                        <a href="{{ route('admin.workshops.index') }}"
                           @class([
                               'flex items-center gap-3 rounded-xl px-3.5 py-2.5 transition duration-150',
                               'bg-primary-700 text-white font-semibold shadow-sm' => request()->routeIs('admin.workshops.*'),
                               'text-slate-300 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.workshops.*')
                           ])>
                            <svg class="h-5 w-5 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.5 6.5a4 4 0 0 0-5.4 4.9L4 16.5 6.5 19l5.1-5.1a4 4 0 0 0 4.9-5.4l-2.6 2.6-2-2 2.6-2.6Z" />
                            </svg>
                            <span>Talleres</span>
                        </a>
                    @endcan
                @endcanany

                @can('ver_usuarios')
                    <div class="pt-5 pb-1">
                        <p class="px-3.5 text-[11px] font-bold uppercase tracking-wider text-accent-400">Analítica</p>
                    </div>

                    <a href="{{ route('admin.metrics.index') }}"
                       @class([
                           'flex items-center gap-3 rounded-xl px-3.5 py-2.5 transition duration-150',
                           'bg-primary-700 text-white font-semibold shadow-xs' => request()->routeIs('admin.metrics.*'),
                           'text-slate-300 hover:bg-white/5 hover:text-white' => !request()->routeIs('admin.metrics.*')
                       ])>
                        <svg class="h-5 w-5 shrink-0 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 20V10M10 20V4M16 20v-7M4 20h16" />
                        </svg>
                        <span>Métricas y Estadísticas</span>
                    </a>
                @endcan
            </nav>

            {{-- Perfil del usuario en el sidebar --}}
            <div class="border-t border-white/10 p-4">
                <div class="flex items-center gap-3 rounded-2xl bg-white/5 p-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-accent-500 font-bold text-slate-950">
                        {{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-xs font-bold text-white">{{ auth()->user()?->name }}</p>
                        <span class="inline-block rounded-md bg-primary-600/50 px-2 py-0.5 text-[10px] font-semibold text-accent-300 border border-primary-500/30">
                            {{ ucfirst(auth()->user()?->getRoleNames()->first() ?? 'Usuario') }}
                        </span>
                    </div>
                </div>
            </div>
        </aside>

        {{-- CONTENIDO PRINCIPAL Y BARRA SUPERIOR --}}
        <div class="flex flex-1 flex-col overflow-hidden">
            {{-- Topbar --}}
            <header class="flex h-16 items-center justify-between border-b border-slate-200/90 bg-white px-4 sm:px-6 lg:px-8 shadow-xs">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true"
                            type="button"
                            class="inline-flex items-center justify-center rounded-xl p-2 text-slate-600 hover:bg-slate-100 lg:hidden">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <h1 class="text-base sm:text-lg font-black tracking-tight text-slate-900">{{ $title ?? 'Panel' }}</h1>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3.5 py-1.5 text-xs font-semibold text-slate-700 shadow-2xs transition hover:bg-slate-50 hover:text-primary-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                        <span class="hidden sm:inline">Ver portal público</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 rounded-xl bg-red-50 px-3.5 py-1.5 text-xs font-bold text-red-700 transition hover:bg-red-100">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            <span>Cerrar sesión</span>
                        </button>
                    </form>
                </div>
            </header>

            {{-- Main Wrapper --}}
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
