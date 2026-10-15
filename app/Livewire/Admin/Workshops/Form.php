<?php

namespace App\Livewire\Admin\Workshops;

use App\Models\Workshop;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?Workshop $workshop = null;

    public string $title = '';
    public ?int $category_id = null;
    public string $description = '';
    public string $purpose = '';
    public string $duration = '';
    public string $modality = '';
    public string $status = 'draft';
    public ?string $start_date = null;
    public ?string $end_date = null;
    public $image;
    public ?string $existingImage = null;

    public function mount($workshop = null)
    {
        abort_unless(auth()->user()->can($workshop ? 'editar_talleres' : 'crear_talleres'), 403);

        if ($workshop) {
            $workshopId = $workshop instanceof Workshop ? $workshop->getKey() : $workshop;
            $this->workshop = Workshop::findOrFail($workshopId);
            $this->title = $this->workshop->title;
            $this->category_id = $this->workshop->category_id;
            $this->description = (string) $this->workshop->description;
            $this->purpose = (string) $this->workshop->purpose;
            $this->duration = (string) $this->workshop->duration;
            $this->modality = (string) $this->workshop->modality;
            $this->status = $this->workshop->status;
            $this->start_date = optional($this->workshop->start_date)->format('Y-m-d');
            $this->end_date = optional($this->workshop->end_date)->format('Y-m-d');
            $this->existingImage = $this->workshop->image;
        }
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'purpose' => 'nullable|string',
            'duration' => 'nullable|string|max:100',
            'modality' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published,archived',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|max:4096',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'purpose' => $this->purpose,
            'duration' => $this->duration,
            'modality' => $this->modality,
            'status' => $this->status,
            'start_date' => $this->start_date ?: null,
            'end_date' => $this->end_date ?: null,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('workshops', 'public');
        }

        if ($this->workshop) {
            $this->workshop->update($data);
        } else {
            Workshop::create($data + ['created_by' => auth()->id()]);
        }

        session()->flash('status', 'Taller guardado correctamente.');

        return redirect()->route('admin.workshops.index');
    }

    public function render()
    {
        return view('livewire.admin.workshops.form', [
            'categories' => Category::orderBy('name')->get(),
        ])->layout('layouts.app', ['title' => $this->workshop ? 'Editar taller' : 'Nuevo taller']);
    }
}
