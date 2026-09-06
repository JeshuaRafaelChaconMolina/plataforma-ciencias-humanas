<?php

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ArticleController;
use App\Http\Controllers\Public\BookController;
use App\Http\Controllers\Public\JournalController;
use App\Http\Controllers\Public\WebsiteController;
use App\Http\Controllers\Public\CourseController;
use App\Http\Controllers\Public\DiplomaController;
use App\Http\Controllers\Public\WorkshopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Rutas publicas (portal) - menu oficial, no se modifica
|--------------------------------------------------------------------------
*/
Route::get('/', HomeController::class)->name('home');

Route::get('/articulos', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articulos/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/libros', [BookController::class, 'index'])->name('books.index');
Route::get('/libros/{book:slug}', [BookController::class, 'show'])->name('books.show');

Route::get('/revistas', [JournalController::class, 'index'])->name('journals.index');
Route::get('/revistas/{journal:slug}', [JournalController::class, 'show'])->name('journals.show');

Route::get('/sitios-web', [WebsiteController::class, 'index'])->name('websites.index');
Route::get('/sitios-web/{website:slug}', [WebsiteController::class, 'show'])->name('websites.show');

Route::get('/cursos', [CourseController::class, 'index'])->name('courses.index');
Route::get('/cursos/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/diplomados', [DiplomaController::class, 'index'])->name('diplomas.index');
Route::get('/diplomados/{diploma:slug}', [DiplomaController::class, 'show'])->name('diplomas.show');

Route::get('/talleres', [WorkshopController::class, 'index'])->name('workshops.index');
Route::get('/talleres/{workshop:slug}', [WorkshopController::class, 'show'])->name('workshops.show');

/*
|--------------------------------------------------------------------------
| Autenticacion (Laravel Breeze + Livewire)
|--------------------------------------------------------------------------
| Estas rutas las genera "php artisan breeze:install livewire" al instalar
| el scaffolding. Se listan aqui como referencia de lo que debe existir
| tras correr ese comando (login, registro, recuperacion de password, etc.)
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Cierre de sesion (Breeze con Volt no crea esta ruta automaticamente)
|--------------------------------------------------------------------------
*/
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Area privada: dashboards por rol
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('panel')->name('dashboard.')->group(function () {
    Route::get('/', function () {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isDocente()) {
            return view('livewire.dashboard.docente');
        }

        if ($user->isInvestigador()) {
            $misArticulos = \App\Models\Article::where('created_by', $user->id)->latest()->take(5)->get();
            $misLibros = \App\Models\Book::where('created_by', $user->id)->latest()->take(5)->get();
            $misRevistas = \App\Models\Journal::where('created_by', $user->id)->latest()->take(5)->get();

            return view('livewire.dashboard.investigador', compact('misArticulos', 'misLibros', 'misRevistas'));
        }

        // Alumno (rol por defecto): catalogo de oferta educativa publicada
        $cursos = \App\Models\Course::published()->latest()->take(6)->get();
        $diplomados = \App\Models\Diploma::published()->latest()->take(6)->get();
        $talleres = \App\Models\Workshop::published()->latest()->take(6)->get();

        return view('livewire.dashboard.alumno', compact('cursos', 'diplomados', 'talleres'));
    })->name('index');
});

/*
|--------------------------------------------------------------------------
| Panel administrativo (protegido por rol via middleware 'role')
|--------------------------------------------------------------------------
*/
require __DIR__.'/admin.php';
