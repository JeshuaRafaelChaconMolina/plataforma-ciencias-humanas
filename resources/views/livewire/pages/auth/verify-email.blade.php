<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard.index', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <h1 class="mt-5 text-4xl font-bold tracking-tight text-slate-900">Verifica tu correo</h1>
    <div class="mt-4 h-1 w-10 bg-accent-500"></div>

    <p class="mt-6 text-sm text-slate-500">
        {{ __('¡Gracias por registrarte! Antes de continuar, ¿podrías verificar tu correo haciendo clic en el enlace que te acabamos de enviar? Si no lo recibiste, con gusto te enviamos otro.') }}
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mt-6 text-sm font-medium text-emerald-600">
            {{ __('Se ha enviado un nuevo enlace de verificación al correo que diste al registrarte.') }}
        </div>
    @endif

    <div class="mt-10 flex items-center justify-between">
        <x-primary-button wire:click="sendVerification">
            {{ __('Reenviar correo de verificación') }}
        </x-primary-button>

        <button wire:click="logout" type="submit" class="text-sm font-medium text-slate-400 hover:text-primary-700">
            {{ __('Cerrar sesión') }}
        </button>
    </div>
</div>