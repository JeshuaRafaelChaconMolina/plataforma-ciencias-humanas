<?php

namespace App\Livewire\Admin\Journals;

use App\Models\Journal;
use App\Models\Category;
use App\Models\FileAttachment;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?Journal $journal = null;

    public string $title = '';
    public ?int $category_id = null;
    public string $description = '';
    public string $edition = '';
    public ?int $year = null;
    public string $status = 'draft';
    public $attachment;
    public ?string $existingFileName = null;
    public ?string $existingFileUrl = null;

    public function mount($journal = null)
    {
        abort_unless(auth()->user()->can($journal ? 'editar_revistas' : 'crear_revistas'), 403);

        if ($journal) {
            $this->journal = Journal::findOrFail($journal);
            $this->title = $this->journal->title;
            $this->category_id = $this->journal->category_id;
            $this->description = (string) $this->journal->description;
            $this->edition = (string) $this->journal->edition;
            $this->year = $this->journal->year;
            $this->status = $this->journal->status;
            $existingFile = $this->journal->files()->latest()->first();
            $this->existingFileName = optional($existingFile)->original_name;
            $this->existingFileUrl = $existingFile ? asset('storage/' . $existingFile->path) : null;
        }
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'edition' => 'nullable|string|max:100',
            'year' => 'nullable|integer|min:1900|max:2100',
            'status' => 'required|in:draft,published',
            'attachment' => 'nullable|file|max:10240',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'edition' => $this->edition,
            'year' => $this->year,
            'status' => $this->status,
            'published_at' => $this->status === 'published' ? now() : null,
            'created_by' => auth()->id(),
        ];

        if ($this->journal) {
            $this->journal->update($data);
        } else {
            $this->journal = Journal::create($data);
        }

        if ($this->attachment) {
            $path = $this->attachment->store('journals', 'public');
            FileAttachment::create([
                'fileable_type' => Journal::class,
                'fileable_id' => $this->journal->id,
                'original_name' => $this->attachment->getClientOriginalName(),
                'path' => $path,
                'disk' => 'public',
                'mime_type' => $this->attachment->getMimeType(),
                'size' => $this->attachment->getSize(),
                'purpose' => 'attachment',
            ]);
        }

        session()->flash('status', 'Revista guardada correctamente.');

        return redirect()->route('admin.journals.index');
    }

    public function render()
    {
        return view('livewire.admin.journals.form', [
            'categories' => Category::orderBy('name')->get(),
        ])->layout('layouts.app', ['title' => $this->journal ? 'Editar revista' : 'Nueva revista']);
    }
}
