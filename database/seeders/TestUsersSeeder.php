<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Docente de prueba
        $docente = User::firstOrCreate(
            ['email' => 'docente@ciencias-humanas.local'],
            [
                'name' => 'Profesor Docente',
                'password' => Hash::make('CambiarEstaClave123!'),
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
        if (! $docente->hasRole('docente')) {
            $docente->assignRole('docente');
        }

        // 2. Alumno de prueba
        $alumno = User::firstOrCreate(
            ['email' => 'alumno@ciencias-humanas.local'],
            [
                'name' => 'Alumno Estudiante',
                'password' => Hash::make('CambiarEstaClave123!'),
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
        if (! $alumno->hasRole('alumno')) {
            $alumno->assignRole('alumno');
        }
    }
}
