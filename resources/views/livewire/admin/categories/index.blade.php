<div>
    <div class="mb-4 flex items-center justify-between">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar categoria..."
               class="w-full max-w-sm rounded-lg border-slate-200 text-sm">
        @can('crear_categorias')
            <a href="{{ route('admin.categories.create') }}" class="btn-primary">+ Nueva categoria</a>
        @endcan
    </div>

    @if(session('status'))
        <div class="mb-4 rounded-lg bg-green-50 px-4 py-2 text-sm text-green-700">{{ session('status') }}</div>
    @endif

    <div class="overflow-hidden rounded-xl border border-slate-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Tipo</th>
                    <th class="px-4 py-3">Descripción</th>
                    <th class="px-4 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($categories as $category)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-700">{{ $category->name }}</td>
                        <td class="px-4 py-3"><x-badge color="neutral">{{ $category->type }}</x-badge></td>
                        <td class="px-4 py-3 text-slate-500">{{ Str::limit($category->description, 60) }}</td>
                        <td class="px-4 py-3 text-right">
                            @can('editar_categorias')
                                <a href="{{ route('admin.categories.edit', $category) }}" class="mr-3 text-sm font-semibold text-primary-700 hover:underline">Editar</a>
                            @endcan
                            @can('eliminar_categorias')
                                <button wire:click="delete({{ $category->id }})" wire:confirm="¿Eliminar esta categoria?" class="text-sm font-semibold text-red-600 hover:underline">Eliminar</button>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-6 text-center text-slate-400">Sin categorias registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $categories->links() }}</div>
</div>
