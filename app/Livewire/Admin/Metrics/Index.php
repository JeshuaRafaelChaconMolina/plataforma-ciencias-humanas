<?php

namespace App\Livewire\Admin\Metrics;

use App\Models\Article;
use App\Models\Book;
use App\Models\Course;
use App\Models\Diploma;
use App\Models\Journal;
use App\Models\User;
use App\Models\Website;
use App\Models\Workshop;
use Livewire\Component;

class Index extends Component
{
    public function mount()
    {
        abort_unless(auth()->user()->can('ver_usuarios'), 403);
    }

    public function render()
    {
        $data = [
            'Usuarios' => User::count(),
            'Articulos' => Article::count(),
            'Libros' => Book::count(),
            'Revistas' => Journal::count(),
            'Sitios Web' => Website::count(),
            'Cursos' => Course::count(),
            'Diplomados' => Diploma::count(),
            'Talleres' => Workshop::count(),
        ];

        return view('livewire.admin.metrics.index', compact('data'))
            ->layout('layouts.app', ['title' => 'Metricas']);
    }
}
