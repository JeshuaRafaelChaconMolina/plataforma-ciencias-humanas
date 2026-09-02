<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Helpers de rol usados en Blade/Livewire para simplificar los @if
    public function isAdmin(): bool
    {
        return $this->hasRole('administrador');
    }

    public function isDocente(): bool
    {
        return $this->hasRole('docente');
    }

    public function isInvestigador(): bool
    {
        return $this->hasRole('investigador');
    }

    public function isAlumno(): bool
    {
        return $this->hasRole('alumno');
    }
}
