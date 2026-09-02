<?php

namespace App\Livewire\Admin\Articles;

use App\Models\Article;
use App\Models\Category;
use App\Models\FileAttachment;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?Article $article = null;

    public string $title = '';
    public ?int $category_id = null;
    public string $description = '';
    public string $author = '';
    public ?int $year = null;
    public string $status = 'draft';
    public $attachment;
    public ?string $existingFileName = null;
    public ?string $existingFileUrl = null;

    public function mount($article = null)
    {
        abort_unless(auth()->user()->can($article ? 'editar_articulos' : 'crear_articulos'), 403);

        if ($article) {
            $this->article = Article::findOrFail($article);
            $this->title = $this->article->title;
            $this->category_id = $this->article->category_id;
            $this->description = (string) $this->article->description;
            $this->author = (string) $this->article->author;
            $this->year = $this->article->year;
            $this->status = $this->article->status;
            $existingFile = $this->article->files()->latest()->first();
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
            'author' => 'nullable|string|max:255',
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
            'author' => $this->author,
            'year' => $this->year,
            'status' => $this->status,
            'published_at' => $this->status === 'published' ? now() : null,
            'created_by' => auth()->id(),
        ];

        if ($this->article) {
            $this->article->update($data);
        } else {
            $this->article = Article::create($data);
        }

        if ($this->attachment) {
            $path = $this->attachment->store('articles', 'public');
            FileAttachment::create([
                'fileable_type' => Article::class,
                'fileable_id' => $this->article->id,
                'original_name' => $this->attachment->getClientOriginalName(),
                'path' => $path,
                'disk' => 'public',
                'mime_type' => $this->attachment->getMimeType(),
                'size' => $this->attachment->getSize(),
                'purpose' => 'attachment',
            ]);
        }

        session()->flash('status', 'Articulo guardado correctamente.');

        return redirect()->route('admin.articles.index');
    }

    public function render()
    {
        return view('livewire.admin.articles.form', [
            'categories' => Category::orderBy('name')->get(),
        ])->layout('layouts.app', ['title' => $this->article ? 'Editar articulo' : 'Nuevo articulo']);
    }
}
