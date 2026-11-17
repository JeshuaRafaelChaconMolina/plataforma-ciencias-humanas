<?php

use App\Models\User;
use App\Services\MoodleService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $key = 'register:'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 10)) {
            throw ValidationException::withMessages([
            'email' => 'Demasiados registros desde esta conexión. Intenta más tarde.',
            ]);
        }

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        RateLimiter::hit($key, 3600);

        // La contraseña en texto plano solo existe en este momento, antes
        // de hashearla. Se usa solo para crear la cuenta en Moodle con la
        // misma contraseña y luego se descarta: no se guarda, no se
        // registra en logs y no se devuelve en ninguna respuesta.
        $plainPassword = $validated['password'];

        $validated['password'] = Hash::make($plainPassword);

        $user = User::create($validated);
        $user->assignRole('alumno');

        // Crear la cuenta en Moodle automáticamente. Si Moodle falla, el
        // registro de Laravel NO falla: el usuario queda creado igual y
        // solo se le avisa que su cuenta del aula quedó pendiente.
        $moodle = app(MoodleService::class)->createUser($validated['name'], $validated['email'], $plainPassword);
        unset($plainPassword);

        if ($moodle['ok']) {
            $user->update([
                'moodle_user_id' => $moodle['id'],
                'moodle_username' => $moodle['username'],
            ]);

            session()->flash('moodle_notice', 'Tu cuenta del aula (Moodle) también quedó creada. Entra a aula.impulsovirtualmx.com con tu usuario "'.$moodle['username'].'" y la misma contraseña de esta cuenta.');
        } else {
            Log::warning('No se pudo crear la cuenta de Moodle al registrarse.', ['email' => $validated['email'], 'error' => $moodle['error']]);

            session()->flash('moodle_warning', 'Tu cuenta del portal quedó creada, pero no se pudo crear tu cuenta del aula (Moodle) automáticamente: '.$moodle['error'].' Pide al administrador que te cree la cuenta en Moodle.');
        }

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('dashboard.index', absolute: false), navigate: true);
    }
}; ?>

<div>
    <h1 class="mt-5 text-4xl font-bold tracking-tight text-slate-900">Crea tu cuenta</h1>
    <div class="mt-4 h-1 w-10 bg-accent-500"></div>

    <form wire:submit="register" class="mt-10 space-y-8">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input wire:model="name" id="name" class="mt-2" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input wire:model="email" id="email" class="mt-2" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input wire:model="password" id="password" class="mt-2"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="mt-2"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <a class="text-sm font-medium text-primary-700 hover:underline" href="{{ route('login') }}" wire:navigate>
                {{ __('¿Ya tienes cuenta?') }}
            </a>
        </div>

        <x-primary-button class="mt-2">
            {{ __('Crear cuenta') }}
        </x-primary-button>
    </form>
</div>