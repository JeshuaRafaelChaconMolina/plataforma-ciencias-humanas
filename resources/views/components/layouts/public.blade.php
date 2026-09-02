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

            {{-- Menu publico oficial: no se modifica --}}
            <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 lg:flex">
                <a href="{{ route('articles.index') }}" class="hover:text-primary-700">Articulos</a>
                <a href="{{ route('books.index') }}" class="hover:text-primary-700">Libros</a>
                <a href="{{ route('journals.index') }}" class="hover:text-primary-700">Revistas</a>
                <a href="{{ route('websites.index') }}" class="hover:text-primary-700">Sitios Web</a>
                <a href="{{ route('courses.index') }}" class="hover:text-primary-700">Cursos</a>
                <a href="{{ route('diplomas.index') }}" class="hover:text-primary-700">Diplomados</a>
                <a href="{{ route('workshops.index') }}" class="hover:text-primary-700">Talleres</a>
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
                <a href="{{ route('articles.index') }}" class="py-1">Articulos</a>
                <a href="{{ route('books.index') }}" class="py-1">Libros</a>
                <a href="{{ route('journals.index') }}" class="py-1">Revistas</a>
                <a href="{{ route('websites.index') }}" class="py-1">Sitios Web</a>
                <a href="{{ route('courses.index') }}" class="py-1">Cursos</a>
                <a href="{{ route('diplomas.index') }}" class="py-1">Diplomados</a>
                <a href="{{ route('workshops.index') }}" class="py-1">Talleres</a>
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
