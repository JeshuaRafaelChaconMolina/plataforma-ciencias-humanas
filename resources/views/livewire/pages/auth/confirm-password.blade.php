<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard.index', absolute: false), navigate: true);
    }
}; ?>

<div>
    <h1 class="mt-5 text-4xl font-bold tracking-tight text-slate-900">Confirma tu contraseña</h1>
    <div class="mt-4 h-1 w-10 bg-accent-500"></div>

    <p class="mt-6 text-sm text-slate-500">
        {{ __('Esta es un área segura de la aplicación. Por favor confirma tu contraseña antes de continuar.') }}
    </p>

    <form wire:submit="confirmPassword" class="mt-10 space-y-8">
        <div>
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input wire:model="password"
                        id="password"
                        class="mt-2"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="mt-2">
            {{ __('Confirmar') }}
        </x-primary-button>
    </form>
</div>