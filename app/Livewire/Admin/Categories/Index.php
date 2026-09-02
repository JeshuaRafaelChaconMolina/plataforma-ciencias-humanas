<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function mount()
    {
        abort_unless(auth()->user()->can('ver_categorias'), 403);
    }

    public function delete($id)
    {
        abort_unless(auth()->user()->can('eliminar_categorias'), 403);

        Category::findOrFail($id)->delete();

        session()->flash('status', 'Categoria eliminada correctamente.');
    }

    public function render()
    {
        $categories = Category::query()
            ->when($this->search, fn ($q) => $q->where('name', 'ilike', "%{$this->search}%"))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.categories.index', compact('categories'))
            ->layout('layouts.app', ['title' => 'Categorias']);
    }
}
