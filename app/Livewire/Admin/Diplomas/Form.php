<?php

namespace App\Livewire\Admin\Diplomas;

use App\Models\Diploma;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?Diploma $diploma = null;

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

    public function mount($diploma = null)
    {
        abort_unless(auth()->user()->can($diploma ? 'editar_diplomados' : 'crear_diplomados'), 403);

        if ($diploma) {
            $this->diploma = Diploma::findOrFail($diploma);
            $this->title = $this->diploma->title;
            $this->category_id = $this->diploma->category_id;
            $this->description = (string) $this->diploma->description;
            $this->purpose = (string) $this->diploma->purpose;
            $this->duration = (string) $this->diploma->duration;
            $this->modality = (string) $this->diploma->modality;
            $this->status = $this->diploma->status;
            $this->start_date = optional($this->diploma->start_date)->format('Y-m-d');
            $this->end_date = optional($this->diploma->end_date)->format('Y-m-d');
            $this->existingImage = $this->diploma->image;
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
            'created_by' => auth()->id(),
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('diplomas', 'public');
        }

        if ($this->diploma) {
            $this->diploma->update($data);
        } else {
            Diploma::create($data);
        }

        session()->flash('status', 'Diplomado guardado correctamente.');

        return redirect()->route('admin.diplomas.index');
    }

    public function render()
    {
        return view('livewire.admin.diplomas.form', [
            'categories' => Category::orderBy('name')->get(),
        ])->layout('layouts.app', ['title' => $this->diploma ? 'Editar diplomado' : 'Nuevo diplomado']);
    }
}
