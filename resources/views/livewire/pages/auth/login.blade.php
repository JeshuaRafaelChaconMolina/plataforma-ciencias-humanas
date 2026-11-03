<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard.index', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="text-center">
        <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-900">Iniciar Sesión</h1>
        <p class="mt-1.5 text-xs sm:text-sm text-slate-500">Ingresa tus credenciales para acceder a tu panel de usuario</p>
    </div>

    <x-auth-session-status class="mt-4" :status="session('status')" />

    <form wire:submit="login" class="mt-7 space-y-5">
        @csrf

        {{-- Campo de Correo Electrónico --}}
        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                Correo institucional / electrónico
            </label>
            <div class="relative">
                <input wire:model="form.email"
                       id="email"
                       type="email"
                       name="email"
                       required
                       autofocus
                       autocomplete="username"
                       placeholder="ejemplo@ciencias-humanas.local"
                       class="w-full rounded-xl border-slate-300 px-4 py-3 text-base text-slate-900 shadow-sm focus:border-primary-600 focus:ring-primary-600">
            </div>
            <x-input-error :messages="$errors->get('form.email')" class="mt-1.5" />
        </div>

        {{-- Campo de Contraseña --}}
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                    Contraseña
                </label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-primary-700 hover:text-primary-800 hover:underline" href="{{ route('password.request') }}" wire:navigate>
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
            <div class="relative">
                <input wire:model="form.password"
                       id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       placeholder="••••••••"
                       class="w-full rounded-xl border-slate-300 px-4 py-3 text-base text-slate-900 shadow-sm focus:border-primary-600 focus:ring-primary-600">
            </div>
            <x-input-error :messages="$errors->get('form.password')" class="mt-1.5" />
        </div>

        {{-- Recordar Sesión --}}
        <div class="flex items-center pt-1">
            <label for="remember" class="inline-flex items-center cursor-pointer">
                <input wire:model="form.remember"
                       id="remember"
                       type="checkbox"
                       class="h-4 w-4 rounded border-slate-300 text-primary-700 focus:ring-primary-600"
                       name="remember">
                <span class="ms-2.5 text-xs sm:text-sm font-medium text-slate-600">Mantener mi sesión iniciada</span>
            </label>
        </div>

        {{-- Botón de Ingreso Más Amplio --}}
        <div class="pt-3">
            <button type="submit"
                    class="flex w-full items-center justify-center gap-2.5 rounded-xl bg-primary-700 py-3.5 px-5 text-center text-base font-bold text-white shadow-md shadow-primary-700/25 transition-all hover:bg-primary-800 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2">
                <span>Ingresar a la plataforma</span>
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </button>
        </div>
    </form>
</div>