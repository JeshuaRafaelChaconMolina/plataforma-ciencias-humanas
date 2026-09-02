<x-layouts.app :title="'Mi panel'">
    <div class="card mb-6 max-w-2xl">
        <h2 class="text-lg font-bold text-primary-800">Bienvenido, {{ auth()->user()->name }}</h2>
        <p class="mt-2 text-sm text-slate-600">
            Este es tu panel como docente. Aqui puedes ver un resumen del contenido academico que has creado.
        </p>
    </div>

    <div class="mb-8 grid grid-cols-3 gap-4">
        <div class="card">
            <p class="text-xs uppercase tracking-wide text-slate-400">Mis articulos</p>
            <p class="mt-1 text-3xl font-extrabold text-primary-700">{{ $misArticulos->count() }}</p>
        </div>
        <div class="card">
            <p class="text-xs uppercase tracking-wide text-slate-400">Mis cursos</p>
            <p class="mt-1 text-3xl font-extrabold text-primary-700">{{ $misCursos->count() }}</p>
        </div>
        <div class="card">
            <p class="text-xs uppercase tracking-wide text-slate-400">Mis talleres</p>
            <p class="mt-1 text-3xl font-extrabold text-primary-700">{{ $misTalleres->count() }}</p>
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

    <h3 class="section-title text-xl">Mis cursos recientes</h3>
    <div class="accent-stripe my-3"></div>
    @if($misCursos->isEmpty())
        <p class="mb-8 text-sm text-slate-500">
            Aun no has creado cursos.
            @can('crear_cursos')
                <a href="{{ route('admin.courses.create') }}" class="font-semibold text-primary-700 hover:underline">Crear el primero</a>
            @endcan
        </p>
    @else
        <div class="mb-8 overflow-hidden rounded-xl border border-slate-100 bg-white">
            <table class="w-full text-left text-sm">
                <tbody class="divide-y divide-slate-100">
                    @foreach($misCursos as $curso)
                        <tr>
                            <td class="px-4 py-3 font-medium text-slate-700">{{ $curso->title }}</td>
                            <td class="px-4 py-3"><x-badge :color="$curso->status === 'published' ? 'primary' : 'neutral'">{{ $curso->status }}</x-badge></td>
                            <td class="px-4 py-3 text-right">
                                @can('editar_cursos')
                                    <a href="{{ route('admin.courses.edit', $curso) }}" class="text-sm font-semibold text-primary-700 hover:underline">Editar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <h3 class="section-title text-xl">Mis talleres recientes</h3>
    <div class="accent-stripe my-3"></div>
    @if($misTalleres->isEmpty())
        <p class="text-sm text-slate-500">
            Aun no has creado talleres.
            @can('crear_talleres')
                <a href="{{ route('admin.workshops.create') }}" class="font-semibold text-primary-700 hover:underline">Crear el primero</a>
            @endcan
        </p>
    @else
        <div class="overflow-hidden rounded-xl border border-slate-100 bg-white">
            <table class="w-full text-left text-sm">
                <tbody class="divide-y divide-slate-100">
                    @foreach($misTalleres as $taller)
                        <tr>
                            <td class="px-4 py-3 font-medium text-slate-700">{{ $taller->title }}</td>
                            <td class="px-4 py-3"><x-badge :color="$taller->status === 'published' ? 'primary' : 'neutral'">{{ $taller->status }}</x-badge></td>
                            <td class="px-4 py-3 text-right">
                                @can('editar_talleres')
                                    <a href="{{ route('admin.workshops.edit', $taller) }}" class="text-sm font-semibold text-primary-700 hover:underline">Editar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-layouts.app>
