<?php

namespace App\Livewire\Admin\Journals;

use App\Models\Journal;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = "";

    public function mount()
    {
        abort_unless(auth()->user()->can("ver_revistas"), 403);
    }

    public function delete($id)
    {
        abort_unless(auth()->user()->can("eliminar_revistas"), 403);

        Journal::findOrFail($id)->delete();

        session()->flash("status", "Registro eliminado correctamente.");
    }

    public function render()
    {
        $items = Journal::query()
            ->when($this->search, fn ($q) => $q->where("title", "ilike", "%{$this->search}%"))
            ->with("category")
            ->latest()
            ->paginate(10);

        return view("livewire.admin.journals.index", compact("items"))
            ->layout("layouts.app", ["title" => "Revistas"]);
    }
}
