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
            // Misma política que Moodle: mínimo 8 caracteres, una
            // mayúscula, una minúscula, un número y un símbolo. Si no se
            // exige aquí, el registro en Laravel pasa pero Moodle rechaza
            // la contraseña ("Invalid parameter value detected") y la
            // cuenta del aula queda pendiente sin que el alumno entienda por qué.
            'password' => ['required', 'string', 'confirmed', Rules\Password::min(8)->mixedCase()->numbers()->symbols()],
        ], [
            'password.min' => 'La contraseña debe tener mínimo 8 caracteres.',
            'password.mixed' => 'La contraseña debe tener al menos una letra mayúscula y una minúscula.',
            'password.numbers' => 'La contraseña debe tener al menos un número.',
            'password.symbols' => 'La contraseña debe tener al menos un símbolo (por ejemplo !, @, # o $).',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
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
            // Se registra también el debuginfo de Moodle cuando viene, para
            // diagnosticar futuros fallos. Nunca se registra la contraseña.
            $logContext = ['email' => $validated['email'], 'error' => $moodle['error']];

            if (! empty($moodle['debuginfo'])) {
                $logContext['moodle_debuginfo'] = $moodle['debuginfo'];
            }

            Log::warning('No se pudo crear la cuenta de Moodle al registrarse.', $logContext);

            // Si Moodle rechazó los datos, lo más probable es la contraseña:
            // decirlo claro, en vez de dejar solo el error genérico de Moodle.
            if (stripos($moodle['error'], 'Invalid parameter') !== false
                || stripos($moodle['error'], 'password') !== false
                || stripos($moodle['error'], 'contraseña') !== false
            ) {
                session()->flash('moodle_warning', 'Tu cuenta del portal quedó creada, pero tu contraseña no fue aceptada por el aula (Moodle): debe tener mínimo 8 caracteres, una mayúscula, una minúscula, un número y un símbolo. Pide al administrador que te cree la cuenta en Moodle con una contraseña que cumpla esos requisitos.');
            } else {
                session()->flash('moodle_warning', 'Tu cuenta del portal quedó creada, pero no se pudo crear tu cuenta del aula (Moodle) automáticamente: '.$moodle['error'].' Pide al administrador que te cree la cuenta en Moodle.');
            }
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
            <p class="mt-2 text-xs text-slate-500">Tu contraseña debe tener mínimo 8 caracteres, una mayúscula, una minúscula, un número y un símbolo, para que también funcione en el aula de Moodle.</p>
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