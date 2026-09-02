<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Models\Category;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(Request $request)
    {
        $query = Website::published()->with('category');

        if ($request->filled('q')) {
            $query->where('title', 'ilike', '%' . $request->q . '%');
        }

        if ($request->filled('categoria')) {
            $query->whereHas('category', fn ($c) => $c->where('slug', $request->categoria));
        }

        $items = $query->latest('published_at')->paginate(12)->withQueryString();
        $categories = Category::ofType('website')->orWhere('type', 'general')->get();

        return view('public.websites.index', compact('items', 'categories'));
    }

    public function show(Website $website)
    {
        abort_unless($website->status === 'published', 404);

        return view('public.websites.show', ['item' => $website]);
    }
}
