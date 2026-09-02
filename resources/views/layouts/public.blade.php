<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }} - Ciencias Humanas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 font-sans text-slate-800">

    {{-- Franja superior de acento (identidad visual: azul + amarillo) --}}
    <div class="h-1.5 w-full bg-gradient-to-r from-primary-600 via-primary-600 to-accent-500"></div>

    <header class="sticky top-0 z-40 border-b border-slate-100 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="text-xl font-extrabold tracking-tight text-primary-700">Ciencias Humanas</span>
                <span class="accent-stripe"></span>
            </a>

            {{-- Menu publico oficial: no se modifica el contenido, solo se le agregan iconos y resaltado --}}
            <nav class="hidden items-center gap-5 text-sm font-medium text-slate-600 lg:flex">
                <a href="{{ route('articles.index') }}" @class(['public-nav-link', 'public-nav-link-active' => request()->routeIs('articles.*')])>
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l4 4v14a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z" /><path stroke-linecap="round" d="M9 12h6M9 16h6M9 8h3" /></svg>
                    Articulos
                </a>
                <a href="{{ route('books.index') }}" @class(['public-nav-link', 'public-nav-link-active' => request()->routeIs('books.*')])>
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6c-1.8-1.2-4-1.8-6.5-1.8V17c2.5 0 4.7.6 6.5 1.8m0-12.8c1.8-1.2 4-1.8 6.5-1.8V17c-2.5 0-4.7.6-6.5 1.8m0-12.8V18.8" /></svg>
                    Libros
                </a>
                <a href="{{ route('journals.index') }}" @class(['public-nav-link', 'public-nav-link-active' => request()->routeIs('journals.*')])>
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 5h12v14H6a2 2 0 0 1-2-2V5Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16 8h4v9a2 2 0 0 1-2 2h-2" /><path stroke-linecap="round" d="M7 9h6M7 12h6M7 15h4" /></svg>
                    Revistas
                </a>
                <a href="{{ route('websites.index') }}" @class(['public-nav-link', 'public-nav-link-active' => request()->routeIs('websites.*')])>
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="8.5" /><path stroke-linecap="round" d="M3.5 12h17M12 3.5c2.5 2.5 2.5 15.5 0 17M12 3.5c-2.5 2.5-2.5 15.5 0 17" /></svg>
                    Sitios Web
                </a>
                <a href="{{ route('courses.index') }}" @class(['public-nav-link', 'public-nav-link-active' => request()->routeIs('courses.*')])>
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="m2.5 9 9.5-4 9.5 4-9.5 4-9.5-4Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 11v4.5c0 1.2 2.7 2.5 6 2.5s6-1.3 6-2.5V11M20 9.5v5" /></svg>
                    Cursos
                </a>
                <a href="{{ route('diplomas.index') }}" @class(['public-nav-link', 'public-nav-link-active' => request()->routeIs('diplomas.*')])>
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="9" r="5.5" /><path stroke-linecap="round" stroke-linejoin="round" d="m8.5 13.5-1.5 7 5-2.5 5 2.5-1.5-7" /></svg>
                    Diplomados
                </a>
                <a href="{{ route('workshops.index') }}" @class(['public-nav-link', 'public-nav-link-active' => request()->routeIs('workshops.*')])>
                    <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M14.5 6.5a4 4 0 0 0-5.4 4.9L4 16.5 6.5 19l5.1-5.1a4 4 0 0 0 4.9-5.4l-2.6 2.6-2-2 2.6-2.6Z" /></svg>
                    Talleres
                </a>
            </nav>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard.index') }}" class="btn-primary">Mi panel</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-primary-700 hover:underline">Iniciar sesion</a>
                @endauth
            </div>
        </div>

        {{-- Menu movil simple con Alpine.js --}}
        <div x-data="{ open: false }" class="border-t border-slate-100 lg:hidden">
            <button @click="open = !open" class="w-full px-4 py-2 text-left text-sm font-semibold text-primary-700">
                Menu ▾
            </button>
            <nav x-show="open" x-cloak class="flex flex-col gap-1 px-4 pb-4 text-sm">
                <a href="{{ route('articles.index') }}" @class(['py-1', 'font-semibold text-primary-700' => request()->routeIs('articles.*')])>Articulos</a>
                <a href="{{ route('books.index') }}" @class(['py-1', 'font-semibold text-primary-700' => request()->routeIs('books.*')])>Libros</a>
                <a href="{{ route('journals.index') }}" @class(['py-1', 'font-semibold text-primary-700' => request()->routeIs('journals.*')])>Revistas</a>
                <a href="{{ route('websites.index') }}" @class(['py-1', 'font-semibold text-primary-700' => request()->routeIs('websites.*')])>Sitios Web</a>
                <a href="{{ route('courses.index') }}" @class(['py-1', 'font-semibold text-primary-700' => request()->routeIs('courses.*')])>Cursos</a>
                <a href="{{ route('diplomas.index') }}" @class(['py-1', 'font-semibold text-primary-700' => request()->routeIs('diplomas.*')])>Diplomados</a>
                <a href="{{ route('workshops.index') }}" @class(['py-1', 'font-semibold text-primary-700' => request()->routeIs('workshops.*')])>Talleres</a>
            </nav>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="mt-20 border-t border-slate-100 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 text-sm text-slate-500 sm:px-6 lg:px-8">
            <p>&copy; {{ date('Y') }} Ciencias Humanas. Plataforma institucional.</p>
        </div>
    </footer>
</body>
</html>
