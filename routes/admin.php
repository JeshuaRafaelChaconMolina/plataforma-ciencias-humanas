<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Users\Index as UsersIndex;

use App\Livewire\Admin\Categories\Index as CategoriesIndex;
use App\Livewire\Admin\Categories\Form as CategoriesForm;

use App\Livewire\Admin\Articles\Index as ArticlesIndex;
use App\Livewire\Admin\Articles\Form as ArticlesForm;

use App\Livewire\Admin\Books\Index as BooksIndex;
use App\Livewire\Admin\Books\Form as BooksForm;

use App\Livewire\Admin\Journals\Index as JournalsIndex;
use App\Livewire\Admin\Journals\Form as JournalsForm;

use App\Livewire\Admin\Websites\Index as WebsitesIndex;
use App\Livewire\Admin\Websites\Form as WebsitesForm;

use App\Livewire\Admin\Courses\Index as CoursesIndex;
use App\Livewire\Admin\Courses\Form as CoursesForm;

use App\Livewire\Admin\Diplomas\Index as DiplomasIndex;
use App\Livewire\Admin\Diplomas\Form as DiplomasForm;

use App\Livewire\Admin\Workshops\Index as WorkshopsIndex;
use App\Livewire\Admin\Workshops\Form as WorkshopsForm;

use App\Livewire\Admin\Metrics\Index as MetricsIndex;

/*
|--------------------------------------------------------------------------
| Panel administrativo
|--------------------------------------------------------------------------
| Fase 2: se agregan las rutas de creacion (create) y edicion (edit) para
| los 8 módulos de contenido, ademas de los listados ya existentes.
*/
Route::middleware(['auth', 'role:administrador'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminDashboard::class)->name('dashboard');

    Route::get('/usuarios', UsersIndex::class)->name('users.index');

    Route::get('/categorias', CategoriesIndex::class)->name('categories.index');
    Route::get('/categorias/nueva', CategoriesForm::class)->name('categories.create');
    Route::get('/categorias/{category}/editar', CategoriesForm::class)->name('categories.edit');

    Route::get('/articulos', ArticlesIndex::class)->name('articles.index');
    Route::get('/articulos/nuevo', ArticlesForm::class)->name('articles.create');
    Route::get('/articulos/{article}/editar', ArticlesForm::class)->name('articles.edit');

    Route::get('/libros', BooksIndex::class)->name('books.index');
    Route::get('/libros/nuevo', BooksForm::class)->name('books.create');
    Route::get('/libros/{book}/editar', BooksForm::class)->name('books.edit');

    Route::get('/revistas', JournalsIndex::class)->name('journals.index');
    Route::get('/revistas/nueva', JournalsForm::class)->name('journals.create');
    Route::get('/revistas/{journal}/editar', JournalsForm::class)->name('journals.edit');

    Route::get('/sitios-web', WebsitesIndex::class)->name('websites.index');
    Route::get('/sitios-web/nuevo', WebsitesForm::class)->name('websites.create');
    Route::get('/sitios-web/{website}/editar', WebsitesForm::class)->name('websites.edit');

    Route::get('/cursos', CoursesIndex::class)->name('courses.index');
    Route::get('/cursos/nuevo', CoursesForm::class)->name('courses.create');
    Route::get('/cursos/{course}/editar', CoursesForm::class)->name('courses.edit');

    Route::get('/diplomados', DiplomasIndex::class)->name('diplomas.index');
    Route::get('/diplomados/nuevo', DiplomasForm::class)->name('diplomas.create');
    Route::get('/diplomados/{diploma}/editar', DiplomasForm::class)->name('diplomas.edit');

    Route::get('/talleres', WorkshopsIndex::class)->name('workshops.index');
    Route::get('/talleres/nuevo', WorkshopsForm::class)->name('workshops.create');
    Route::get('/talleres/{workshop}/editar', WorkshopsForm::class)->name('workshops.edit');

    Route::get('/metricas', MetricsIndex::class)->name('metrics.index');
});
