<?php

namespace App\Livewire\Admin\Websites;

use App\Models\Website;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = "";

    public function mount()
    {
        abort_unless(auth()->user()->can("ver_sitios_web"), 403);
    }

    public function delete($id)
    {
        abort_unless(auth()->user()->can("eliminar_sitios_web"), 403);

        Website::findOrFail($id)->delete();

        session()->flash("status", "Registro eliminado correctamente.");
    }

    public function render()
    {
        $items = Website::query()
            ->when($this->search, fn ($q) => $q->where("title", "ilike", "%{$this->search}%"))
            ->with("category")
            ->latest()
            ->paginate(10);

        return view("livewire.admin.websites.index", compact("items"))
            ->layout("layouts.app", ["title" => "Sitios Web"]);
    }
}
