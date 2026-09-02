<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::published()->with('category');

        if ($request->filled('q')) {
            $query->where('title', 'ilike', '%' . $request->q . '%');
        }

        if ($request->filled('categoria')) {
            $query->whereHas('category', fn ($c) => $c->where('slug', $request->categoria));
        }

        $items = $query->latest('published_at')->paginate(12)->withQueryString();
        $categories = Category::ofType('article')->orWhere('type', 'general')->get();

        return view('public.articles.index', compact('items', 'categories'));
    }

    public function show(Article $article)
    {
        abort_unless($article->status === 'published', 404);

        return view('public.articles.show', ['item' => $article]);
    }
}
