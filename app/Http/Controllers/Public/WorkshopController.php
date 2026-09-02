<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    public function index(Request $request)
    {
        $query = Workshop::published()->with('category');

        if ($request->filled('q')) {
            $query->where('title', 'ilike', '%' . $request->q . '%');
        }

        $workshops = $query->latest()->paginate(9)->withQueryString();
        $categories = Category::ofType('workshop')->orWhere('type', 'general')->get();

        return view('public.workshops.index', compact('workshops', 'categories'));
    }

    public function show(Workshop $workshop)
    {
        abort_unless($workshop->status === 'published', 404);

        return view('public.workshops.show', compact('workshop'));
    }
}
