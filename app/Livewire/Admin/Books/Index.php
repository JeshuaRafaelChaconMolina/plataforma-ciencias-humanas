<?php

namespace App\Livewire\Admin\Books;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = "";

    public function mount()
    {
        abort_unless(auth()->user()->can("ver_libros"), 403);
    }

    public function delete($id)
    {
        abort_unless(auth()->user()->can("eliminar_libros"), 403);

        Book::findOrFail($id)->delete();

        session()->flash("status", "Registro eliminado correctamente.");
    }

    public function render()
    {
        $items = Book::query()
            ->when($this->search, fn ($q) => $q->where("title", "ilike", "%{$this->search}%"))
            ->with("category")
            ->latest()
            ->paginate(10);

        return view("livewire.admin.books.index", compact("items"))
            ->layout("layouts.app", ["title" => "Libros"]);
    }
}
