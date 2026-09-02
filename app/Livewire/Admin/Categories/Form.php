<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;

class Form extends Component
{
    public ?Category $category = null;

    public string $name = '';
    public string $type = 'general';
    public string $description = '';

    public function mount($category = null)
    {
        abort_unless(auth()->user()->can($category ? 'editar_categorias' : 'crear_categorias'), 403);

        if ($category) {
            $this->category = Category::findOrFail($category);
            $this->name = $this->category->name;
            $this->type = $this->category->type;
            $this->description = (string) $this->category->description;
        }
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:general,article,book,journal,website,course,diploma,workshop',
            'description' => 'nullable|string',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
        ];

        if ($this->category) {
            $this->category->update($data);
        } else {
            Category::create($data);
        }

        session()->flash('status', 'Categoria guardada correctamente.');

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.admin.categories.form')
            ->layout('layouts.app', ['title' => $this->category ? 'Editar categoria' : 'Nueva categoria']);
    }
}
