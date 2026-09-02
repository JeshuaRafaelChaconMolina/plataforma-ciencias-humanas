<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Diploma;
use Illuminate\Http\Request;

class DiplomaController extends Controller
{
    public function index(Request $request)
    {
        $query = Diploma::published()->with('category');

        if ($request->filled('q')) {
            $query->where('title', 'ilike', '%' . $request->q . '%');
        }

        $diplomas = $query->latest()->paginate(9)->withQueryString();
        $categories = Category::ofType('diploma')->orWhere('type', 'general')->get();

        return view('public.diplomas.index', compact('diplomas', 'categories'));
    }

    public function show(Diploma $diploma)
    {
        abort_unless($diploma->status === 'published', 404);

        // Composicion por cursos disponible desde el modelo (diploma->courses),
        // se muestra en la vista solo si ya existen relaciones cargadas.
        $diploma->load('courses');

        return view('public.diplomas.show', compact('diploma'));
    }
}
