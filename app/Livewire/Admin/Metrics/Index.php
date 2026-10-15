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
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Index extends Component
{
    public function mount()
    {
        abort_unless(auth()->user()->can('ver_usuarios'), 403);
    }

    public function render()
    {
        $modules = [
            'Artículos' => Article::class,
            'Libros' => Book::class,
            'Revistas' => Journal::class,
            'Sitios web' => Website::class,
            'Cursos' => Course::class,
            'Diplomados' => Diploma::class,
            'Talleres' => Workshop::class,
        ];

        $rows = [];
        foreach ($modules as $label => $model) {
            $hasStatus = Schema::hasColumn((new $model)->getTable(), 'status');

            $byStatus = $hasStatus
                ? $model::query()->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status')
                : collect();

            $rows[] = [
                'label' => $label,
                'total' => $hasStatus ? (int) $byStatus->sum() : $model::count(),
                'published' => $hasStatus ? (int) ($byStatus['published'] ?? 0) : null,
                'draft' => $hasStatus ? (int) ($byStatus['draft'] ?? 0) : null,
                'archived' => $hasStatus ? (int) ($byStatus['archived'] ?? 0) : null,
            ];
        }

        $rows = collect($rows);

        $summary = [
            'Usuarios' => User::count(),
            'Contenido total' => $rows->sum('total'),
            'Publicados' => $rows->sum('published'),
            'Borradores' => $rows->sum('draft'),
        ];

        return view('livewire.admin.metrics.index', compact('rows', 'summary'))
            ->layout('layouts.app', ['title' => 'Métricas']);
    }
}