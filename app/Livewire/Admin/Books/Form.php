<?php

namespace App\Livewire\Admin\Books;

use App\Models\Book;
use App\Models\Category;
use App\Models\FileAttachment;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?Book $book = null;

    public string $title = '';
    public ?int $category_id = null;
    public string $description = '';
    public string $author = '';
    public string $isbn = '';
    public ?int $year = null;
    public string $status = 'draft';
    public $attachment;
    public ?string $existingFileName = null;
    public ?string $existingFileUrl = null;

    public function mount($book = null)
    {
        abort_unless(auth()->user()->can($book ? 'editar_libros' : 'crear_libros'), 403);

        if ($book) {
            $this->book = Book::findOrFail($book);
            $this->title = $this->book->title;
            $this->category_id = $this->book->category_id;
            $this->description = (string) $this->book->description;
            $this->author = (string) $this->book->author;
            $this->isbn = (string) $this->book->isbn;
            $this->year = $this->book->year;
            $this->status = $this->book->status;
            $existingFile = $this->book->files()->latest()->first();
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
            'isbn' => 'nullable|string|max:50',
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
            'isbn' => $this->isbn,
            'year' => $this->year,
            'status' => $this->status,
            'published_at' => $this->status === 'published' ? now() : null,
            'created_by' => auth()->id(),
        ];

        if ($this->book) {
            $this->book->update($data);
        } else {
            $this->book = Book::create($data);
        }

        if ($this->attachment) {
            $path = $this->attachment->store('books', 'public');
            FileAttachment::create([
                'fileable_type' => Book::class,
                'fileable_id' => $this->book->id,
                'original_name' => $this->attachment->getClientOriginalName(),
                'path' => $path,
                'disk' => 'public',
                'mime_type' => $this->attachment->getMimeType(),
                'size' => $this->attachment->getSize(),
                'purpose' => 'attachment',
            ]);
        }

        session()->flash('status', 'Libro guardado correctamente.');

        return redirect()->route('admin.books.index');
    }

    public function render()
    {
        return view('livewire.admin.books.form', [
            'categories' => Category::orderBy('name')->get(),
        ])->layout('layouts.app', ['title' => $this->book ? 'Editar libro' : 'Nuevo libro']);
    }
}
