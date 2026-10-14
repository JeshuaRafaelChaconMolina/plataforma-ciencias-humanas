<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Book;
use App\Models\Journal;
use App\Models\Category;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    protected array $tipos = [
        'articulos' => ['model' => Article::class, 'categoryType' => 'article', 'label' => 'Articulos', 'route' => 'articles.show'],
        'libros'    => ['model' => Book::class,    'categoryType' => 'book',    'label' => 'Libros',    'route' => 'books.show'],
        'revistas'  => ['model' => Journal::class, 'categoryType' => 'journal', 'label' => 'Revistas',  'route' => 'journals.show'],
    ];

    public function index(Request $request)
    {
        $tipo = $request->query('tipo', 'articulos');

        if (! array_key_exists($tipo, $this->tipos)) {
            $tipo = 'articulos';
        }

        $config = $this->tipos[$tipo];
        $modelClass = $config['model'];

        $query = $modelClass::published()->with('category');

        if ($request->filled('q')) {
            $query->where('title', 'ilike', '%' . $request->q . '%');
        }

        if ($request->filled('categoria')) {
            $query->whereHas('category', fn ($c) => $c->where('slug', $request->categoria));
        }

        $items = $query->latest('published_at')->paginate(12)->withQueryString();
        $categories = Category::ofType($config['categoryType'])->orWhere('type', 'general')->get();

        return view('public.library.index', [
            'items' => $items,
            'categories' => $categories,
            'tipo' => $tipo,
            'tipos' => $this->tipos,
        ]);
    }
}