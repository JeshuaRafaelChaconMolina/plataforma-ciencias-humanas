<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::published()->with('category');

        if ($request->filled('q')) {
            $query->where('title', 'ilike', '%' . $request->q . '%');
        }

        if ($request->filled('categoria')) {
            $query->whereHas('category', fn ($c) => $c->where('slug', $request->categoria));
        }

        $items = $query->latest('published_at')->paginate(12)->withQueryString();
        $categories = Category::ofType('book')->orWhere('type', 'general')->get();

        return view('public.books.index', compact('items', 'categories'));
    }

    public function show(Book $book)
    {
        abort_unless($book->status === 'published', 404);

        return view('public.books.show', ['item' => $book]);
    }
}
