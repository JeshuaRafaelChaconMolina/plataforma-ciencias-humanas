<?php

namespace App\Livewire\Admin\Workshops;

use App\Models\Workshop;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = "";

    public function mount()
    {
        abort_unless(auth()->user()->can("ver_talleres"), 403);
    }

    public function delete($id)
    {
        abort_unless(auth()->user()->can("eliminar_talleres"), 403);

        Workshop::findOrFail($id)->delete();

        session()->flash("status", "Registro eliminado correctamente.");
    }

    public function render()
    {
        $items = Workshop::query()
            ->when($this->search, fn ($q) => $q->where("title", "ilike", "%{$this->search}%"))
            ->with("category")
            ->latest()
            ->paginate(10);

        return view("livewire.admin.workshops.index", compact("items"))
            ->layout("layouts.app", ["title" => "Talleres"]);
    }
}
