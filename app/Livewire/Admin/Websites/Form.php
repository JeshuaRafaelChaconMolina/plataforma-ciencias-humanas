<?php

namespace App\Livewire\Admin\Websites;

use App\Models\Website;
use App\Models\Category;
use Livewire\Component;

class Form extends Component
{
    public ?Website $website = null;

    public string $title = '';
    public ?int $category_id = null;
    public string $description = '';
    public string $url = '';
    public string $status = 'draft';

    public function mount($website = null)
    {
        abort_unless(auth()->user()->can($website ? 'editar_sitios_web' : 'crear_sitios_web'), 403);

        if ($website) {
            $websiteId = $website instanceof Website ? $website->getKey() : $website;
            $this->website = Website::findOrFail($websiteId);
            $this->title = $this->website->title;
            $this->category_id = $this->website->category_id;
            $this->description = (string) $this->website->description;
            $this->url = $this->website->url;
            $this->status = $this->website->status;
        }
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'url' => 'required|url|max:2048',
            'status' => 'required|in:draft,published',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'url' => $this->url,
            'status' => $this->status,
            'published_at' => $this->status === 'published' ? now() : null,
        ];

        if ($this->website) {
            $this->website->update($data);
        } else {
            Website::create($data + ['created_by' => auth()->id()]);
        }

        session()->flash('status', 'Sitio web guardado correctamente.');

        return redirect()->route('admin.websites.index');
    }

    public function render()
    {
        return view('livewire.admin.websites.form', [
            'categories' => Category::orderBy('name')->get(),
        ])->layout('layouts.app', ['title' => $this->website ? 'Editar sitio web' : 'Nuevo sitio web']);
    }
}
