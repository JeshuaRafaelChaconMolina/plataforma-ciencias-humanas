<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use App\Models\Category;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        $query = Journal::published()->with('category');

        if ($request->filled('q')) {
            $query->where('title', 'ilike', '%' . $request->q . '%');
        }

        if ($request->filled('categoria')) {
            $query->whereHas('category', fn ($c) => $c->where('slug', $request->categoria));
        }

        $items = $query->latest('published_at')->paginate(12)->withQueryString();
        $categories = Category::ofType('journal')->orWhere('type', 'general')->get();

        return view('public.journals.index', compact('items', 'categories'));
    }

    public function show(Journal $journal)
    {
        abort_unless($journal->status === 'published', 404);

        return view('public.journals.show', ['item' => $journal]);
    }
}
