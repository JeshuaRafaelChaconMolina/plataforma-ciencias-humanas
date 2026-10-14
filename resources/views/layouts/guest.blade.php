<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="h-1.5 w-full bg-gradient-to-r from-primary-600 via-primary-600 to-accent-500"></div>

        <div class="flex min-h-[calc(100vh-6px)] items-center justify-center px-4">
            <div class="w-full max-w-sm py-16">
                <a href="/" wire:navigate class="text-xs font-semibold uppercase tracking-widest text-slate-400 hover:text-primary-700">
                    Ciencias Humanas
                </a>

                {{ $slot }}

                <a href="/" wire:navigate class="mt-10 block text-sm text-slate-400 hover:text-primary-700">
                    &larr; Volver al portal
                </a>
            </div>
        </div>
    </body>
</html>