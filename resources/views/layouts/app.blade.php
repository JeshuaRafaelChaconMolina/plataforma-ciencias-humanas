<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Panel' }} - Ciencias Humanas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-50 font-sans text-slate-800">
    <div class="flex min-h-screen">

        {{-- Sidebar del panel (admin y dashboards privados) --}}
        <aside class="hidden w-64 flex-col border-r border-slate-100 bg-primary-800 text-white lg:flex">
            <div class="flex items-center gap-2 px-6 py-5">
                <span class="text-lg font-extrabold">Ciencias Humanas</span>
            </div>
            <div class="accent-stripe mx-6"></div>

            <nav class="mt-6 flex-1 space-y-1 px-3 text-sm">
                @can('ver_usuarios')
                    <a href="{{ route('admin.dashboard') }}" @class(['nav-link', 'nav-link-active' => request()->routeIs('admin.dashboard')])>
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 4l9 6.5M5 9.5V19a1 1 0 0 0 1 1h4v-5h4v5h4a1 1 0 0 0 1-1V9.5" /></svg>
                        Inicio
                    </a>

                    <p class="mt-4 px-3 text-xs font-semibold uppercase tracking-wide text-primary-300">Gestion</p>

                    <a href="{{ route('admin.users.index') }}" @class(['nav-link', 'nav-link-active' => request()->routeIs('admin.users.*')])>
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="8" r="3" /><path stroke-linecap="round" stroke-linejoin="round" d="M3.5 20a5.5 5.5 0 0 1 11 0" /><circle cx="17" cy="9" r="2.3" /><path stroke-linecap="round" stroke-linejoin="round" d="M14.8 20a4.3 4.3 0 0 1 6.7-3.6" /></svg>
                        Usuarios
                    </a>
                    <a href="{{ route('admin.categories.index') }}" @class(['nav-link', 'nav-link-active' => request()->routeIs('admin.categories.*')])>
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h7l9 9-7 7-9-9V4Z" /><circle cx="8.5" cy="8.5" r="1.2" fill="currentColor" stroke="none" /></svg>
                        Categorias
                    </a>
                @endcan

                @canany(['ver_articulos', 'ver_libros', 'ver_revistas', 'ver_sitios_web'])
                    <p class="mt-4 px-3 text-xs font-semibold uppercase tracking-wide text-primary-300">Repositorio</p>

                    @can('ver_articulos')
                        <a href="{{ route('admin.articles.index') }}" @class(['nav-link', 'nav-link-active' => request()->routeIs('admin.articles.*')])>
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l4 4v14a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z" /><path stroke-linecap="round" d="M9 12h6M9 16h6M9 8h3" /></svg>
                            Articulos
                        </a>
                    @endcan
                    @can('ver_libros')
                        <a href="{{ route('admin.books.index') }}" @class(['nav-link', 'nav-link-active' => request()->routeIs('admin.books.*')])>
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6c-1.8-1.2-4-1.8-6.5-1.8V17c2.5 0 4.7.6 6.5 1.8m0-12.8c1.8-1.2 4-1.8 6.5-1.8V17c-2.5 0-4.7.6-6.5 1.8m0-12.8V18.8" /></svg>
                            Libros
                        </a>
                    @endcan
                    @can('ver_revistas')
                        <a href="{{ route('admin.journals.index') }}" @class(['nav-link', 'nav-link-active' => request()->routeIs('admin.journals.*')])>
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 5h12v14H6a2 2 0 0 1-2-2V5Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16 8h4v9a2 2 0 0 1-2 2h-2" /><path stroke-linecap="round" d="M7 9h6M7 12h6M7 15h4" /></svg>
                            Revistas
                        </a>
                    @endcan
                    @can('ver_sitios_web')
                        <a href="{{ route('admin.websites.index') }}" @class(['nav-link', 'nav-link-active' => request()->routeIs('admin.websites.*')])>
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="8.5" /><path stroke-linecap="round" d="M3.5 12h17M12 3.5c2.5 2.5 2.5 15.5 0 17M12 3.5c-2.5 2.5-2.5 15.5 0 17" /></svg>
                            Sitios Web
                        </a>
                    @endcan
                @endcanany

                @canany(['ver_cursos', 'ver_diplomados', 'ver_talleres'])
                    <p class="mt-4 px-3 text-xs font-semibold uppercase tracking-wide text-primary-300">Oferta educativa</p>

                    @can('ver_cursos')
                        <a href="{{ route('admin.courses.index') }}" @class(['nav-link', 'nav-link-active' => request()->routeIs('admin.courses.*')])>
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m2.5 9 9.5-4 9.5 4-9.5 4-9.5-4Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 11v4.5c0 1.2 2.7 2.5 6 2.5s6-1.3 6-2.5V11M20 9.5v5" /></svg>
                            Cursos
                        </a>
                    @endcan
                    @can('ver_diplomados')
                        <a href="{{ route('admin.diplomas.index') }}" @class(['nav-link', 'nav-link-active' => request()->routeIs('admin.diplomas.*')])>
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="9" r="5.5" /><path stroke-linecap="round" stroke-linejoin="round" d="m8.5 13.5-1.5 7 5-2.5 5 2.5-1.5-7" /></svg>
                            Diplomados
                        </a>
                    @endcan
                    @can('ver_talleres')
                        <a href="{{ route('admin.workshops.index') }}" @class(['nav-link', 'nav-link-active' => request()->routeIs('admin.workshops.*')])>
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.5 6.5a4 4 0 0 0-5.4 4.9L4 16.5 6.5 19l5.1-5.1a4 4 0 0 0 4.9-5.4l-2.6 2.6-2-2 2.6-2.6Z" /></svg>
                            Talleres
                        </a>
                    @endcan
                @endcanany

                @can('ver_usuarios')
                    <p class="mt-4 px-3 text-xs font-semibold uppercase tracking-wide text-primary-300">Sistema</p>
                    <a href="{{ route('admin.metrics.index') }}" @class(['nav-link', 'nav-link-active' => request()->routeIs('admin.metrics.*')])>
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 20V10M10 20V4M16 20v-7M4 20h16" /></svg>
                        Metricas
                    </a>
                @endcan
            </nav>

            <div class="border-t border-primary-700 p-4 text-xs text-primary-100">
                <span class="font-semibold text-white">{{ auth()->user()?->name }}</span><br>
                <span class="text-primary-300">{{ auth()->user()?->getRoleNames()->first() }}</span>
            </div>
        </aside>

        <div class="flex-1">
            <header class="flex items-center justify-between border-b border-slate-100 bg-white px-6 py-4 shadow-sm">
                <h1 class="text-lg font-semibold text-primary-800">{{ $title ?? 'Panel' }}</h1>
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="text-sm text-slate-500 hover:text-primary-700">Ver portal publico</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-red-600 hover:underline">Cerrar sesion</button>
                    </form>
                </div>
            </header>

            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
