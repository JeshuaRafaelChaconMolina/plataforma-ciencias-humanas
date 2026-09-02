<?php

namespace App\Livewire\Admin\Courses;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = "";

    public function mount()
    {
        abort_unless(auth()->user()->can("ver_cursos"), 403);
    }

    public function delete($id)
    {
        abort_unless(auth()->user()->can("eliminar_cursos"), 403);

        Course::findOrFail($id)->delete();

        session()->flash("status", "Registro eliminado correctamente.");
    }

    public function render()
    {
        $items = Course::query()
            ->when($this->search, fn ($q) => $q->where("title", "ilike", "%{$this->search}%"))
            ->with("category")
            ->latest()
            ->paginate(10);

        return view("livewire.admin.courses.index", compact("items"))
            ->layout("layouts.app", ["title" => "Cursos"]);
    }
}
