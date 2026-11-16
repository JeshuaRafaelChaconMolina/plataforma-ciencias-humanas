<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Impulso Virtual') }} — Acceso</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logo-grupo-circular.png') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="min-h-full font-sans text-slate-800 antialiased flex flex-col justify-between relative bg-slate-50 overflow-x-hidden">
        {{-- Franja superior institucional --}}
        <div class="h-1.5 w-full bg-gradient-to-r from-primary-800 via-primary-600 to-accent-500 fixed top-0 left-0 right-0 z-50"></div>

        {{-- Fondo Fotográfico de Estudio de Humanidades con Overlay Suave --}}
        <div class="fixed inset-0 z-0 overflow-hidden">
            <img src="{{ asset('images/desk-bg.jpg') }}" alt="Impulso Virtual" class="h-full w-full object-cover object-center">
            <div class="absolute inset-0 bg-slate-950/50 backdrop-blur-[2px]"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-slate-950/50"></div>
        </div>

        {{-- Contenedor Principal Centrado --}}
        <div class="relative z-10 flex flex-1 items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
            <div class="w-full max-w-lg">
                {{-- Tarjeta de Autenticación Blanca Nítida y Amplia --}}
                <div class="rounded-3xl border border-slate-200/90 bg-white p-8 sm:p-11 shadow-2xl shadow-slate-300/60">
                    {{-- Encabezado de la Tarjeta --}}
                    <div class="text-center pb-6 border-b border-slate-100">
                        <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-3.5 group">
                            <img src="{{ asset('images/logo-grupo-circular.png') }}" alt="Impulso Virtual" class="h-14 w-14 rounded-full object-cover shadow-md shadow-primary-700/25 transition-transform duration-200 group-hover:scale-105">
                            <div class="text-left">
                                <span class="block text-[11px] font-bold uppercase tracking-widest text-primary-700">Plataforma educativa</span>
                                <span class="text-xl font-black tracking-tight text-slate-900 group-hover:text-primary-700 transition-colors">Impulso Virtual</span>
                            </div>
                        </a>
                    </div>

                    {{-- Formulario Inyectado --}}
                    <div class="pt-6">
                        {{ $slot }}
                    </div>
                </div>

                {{-- Enlace para regresar al portal --}}
                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center gap-2 text-xs font-semibold text-white/90 hover:text-white bg-slate-900/60 hover:bg-slate-900/80 px-4 py-2.5 rounded-xl border border-white/10 backdrop-blur-sm shadow-sm transition">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        <span>Volver al portal público</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Footer Sencillo Institucional --}}
        <div class="relative z-10 py-5 text-center text-xs text-slate-300">
            &copy; {{ date('Y') }} Impulso Virtual. Plataforma educativa de libre acceso.
        </div>

        @livewireScripts
    </body>
</html>