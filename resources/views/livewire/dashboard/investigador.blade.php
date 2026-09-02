<x-layouts.app :title="'Mi panel'">
    <div class="card mb-6 max-w-2xl">
        <h2 class="text-lg font-bold text-primary-800">Bienvenido, {{ auth()->user()->name }}</h2>
        <p class="mt-2 text-sm text-slate-600">
            Este es tu panel como investigador. Aqui puedes ver un resumen de tu produccion academica registrada
            en el repositorio institucional.
        </p>
    </div>

    <div class="mb-8 grid grid-cols-3 gap-4">
        <div class="card">
            <p class="text-xs uppercase tracking-wide text-slate-400">Mis articulos</p>
            <p class="mt-1 text-3xl font-extrabold text-primary-700">{{ $misArticulos->count() }}</p>
        </div>
        <div class="card">
            <p class="text-xs uppercase tracking-wide text-slate-400">Mis libros</p>
            <p class="mt-1 text-3xl font-extrabold text-primary-700">{{ $misLibros->count() }}</p>
        </div>
        <div class="card">
            <p class="text-xs uppercase tracking-wide text-slate-400">Mis revistas</p>
            <p class="mt-1 text-3xl font-extrabold text-primary-700">{{ $misRevistas->count() }}</p>
        </div>
    </div>

    <h3 class="section-title text-xl">Mis articulos recientes</h3>
    <div class="accent-stripe my-3"></div>
    @if($misArticulos->isEmpty())
        <p class="mb-8 text-sm text-slate-500">
            Aun no has creado articulos.
            @can('crear_articulos')
                <a href="{{ route('admin.articles.create') }}" class="font-semibold text-primary-700 hover:underline">Crear el primero</a>
            @endcan
        </p>
    @else
        <div class="mb-8 overflow-hidden rounded-xl border border-slate-100 bg-white">
            <table class="w-full text-left text-sm">
                <tbody class="divide-y divide-slate-100">
                    @foreach($misArticulos as $articulo)
                        <tr>
                            <td class="px-4 py-3 font-medium text-slate-700">{{ $articulo->title }}</td>
                            <td class="px-4 py-3"><x-badge :color="$articulo->status === 'published' ? 'primary' : 'neutral'">{{ $articulo->status }}</x-badge></td>
                            <td class="px-4 py-3 text-right">
                                @can('editar_articulos')
                                    <a href="{{ route('admin.articles.edit', $articulo) }}" class="text-sm font-semibold text-primary-700 hover:underline">Editar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <h3 class="section-title text-xl">Mis libros recientes</h3>
    <div class="accent-stripe my-3"></div>
    @if($misLibros->isEmpty())
        <p class="mb-8 text-sm text-slate-500">
            Aun no has creado libros.
            @can('crear_libros')
                <a href="{{ route('admin.books.create') }}" class="font-semibold text-primary-700 hover:underline">Crear el primero</a>
            @endcan
        </p>
    @else
        <div class="mb-8 overflow-hidden rounded-xl border border-slate-100 bg-white">
            <table class="w-full text-left text-sm">
                <tbody class="divide-y divide-slate-100">
                    @foreach($misLibros as $libro)
                        <tr>
                            <td class="px-4 py-3 font-medium text-slate-700">{{ $libro->title }}</td>
                            <td class="px-4 py-3"><x-badge :color="$libro->status === 'published' ? 'primary' : 'neutral'">{{ $libro->status }}</x-badge></td>
                            <td class="px-4 py-3 text-right">
                                @can('editar_libros')
                                    <a href="{{ route('admin.books.edit', $libro) }}" class="text-sm font-semibold text-primary-700 hover:underline">Editar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <h3 class="section-title text-xl">Mis revistas recientes</h3>
    <div class="accent-stripe my-3"></div>
    @if($misRevistas->isEmpty())
        <p class="text-sm text-slate-500">
            Aun no has creado revistas.
            @can('crear_revistas')
                <a href="{{ route('admin.journals.create') }}" class="font-semibold text-primary-700 hover:underline">Crear la primera</a>
            @endcan
        </p>
    @else
        <div class="overflow-hidden rounded-xl border border-slate-100 bg-white">
            <table class="w-full text-left text-sm">
                <tbody class="divide-y divide-slate-100">
                    @foreach($misRevistas as $revista)
                        <tr>
                            <td class="px-4 py-3 font-medium text-slate-700">{{ $revista->title }}</td>
                            <td class="px-4 py-3"><x-badge :color="$revista->status === 'published' ? 'primary' : 'neutral'">{{ $revista->status }}</x-badge></td>
                            <td class="px-4 py-3 text-right">
                                @can('editar_revistas')
                                    <a href="{{ route('admin.journals.edit', $revista) }}" class="text-sm font-semibold text-primary-700 hover:underline">Editar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-layouts.app>
