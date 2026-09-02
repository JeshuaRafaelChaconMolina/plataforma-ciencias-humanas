<?php

namespace App\Livewire\Admin\Diplomas;

use App\Models\Diploma;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = "";

    public function mount()
    {
        abort_unless(auth()->user()->can("ver_diplomados"), 403);
    }

    public function delete($id)
    {
        abort_unless(auth()->user()->can("eliminar_diplomados"), 403);

        Diploma::findOrFail($id)->delete();

        session()->flash("status", "Registro eliminado correctamente.");
    }

    public function render()
    {
        $items = Diploma::query()
            ->when($this->search, fn ($q) => $q->where("title", "ilike", "%{$this->search}%"))
            ->with("category")
            ->latest()
            ->paginate(10);

        return view("livewire.admin.diplomas.index", compact("items"))
            ->layout("layouts.app", ["title" => "Diplomados"]);
    }
}
