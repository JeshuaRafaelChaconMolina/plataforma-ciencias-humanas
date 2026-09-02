<?php

namespace App\Livewire\Admin;

use App\Models\Article;
use App\Models\Book;
use App\Models\Course;
use App\Models\Diploma;
use App\Models\Journal;
use App\Models\User;
use App\Models\Website;
use App\Models\Workshop;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        // Metricas basicas para el panel de inicio (seccion K del plan de Fase 1)
        $metrics = [
            'usuarios' => User::count(),
            'articulos' => Article::count(),
            'libros' => Book::count(),
            'revistas' => Journal::count(),
            'sitios_web' => Website::count(),
            'cursos' => Course::count(),
            'diplomados' => Diploma::count(),
            'talleres' => Workshop::count(),
        ];

        return view('livewire.admin.dashboard', compact('metrics'))
            ->layout('layouts.app', ['title' => 'Panel administrativo']);
    }
}
