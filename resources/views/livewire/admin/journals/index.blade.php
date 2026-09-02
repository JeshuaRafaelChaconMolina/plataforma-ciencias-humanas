<div>
    <div class="mb-4 flex items-center justify-between">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar Revista..."
               class="w-full max-w-sm rounded-lg border-slate-200 text-sm">
        @can('crear_revistas')
            <a href="{{ route('admin.journals.create') }}" class="btn-primary">+ Nuevo</a>
        @endcan
    </div>

    @if(session('status'))
        <div class="mb-4 rounded-lg bg-green-50 px-4 py-2 text-sm text-green-700">{{ session('status') }}</div>
    @endif

    <div class="overflow-hidden rounded-xl border border-slate-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3">Titulo</th>
                    <th class="px-4 py-3">Categoria</th>
                    <th class="px-4 py-3">Estado</th>
                    <th class="px-4 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($items as $item)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-700">{{ $item->title }}</td>
                        <td class="px-4 py-3"><x-badge color="neutral">{{ $item->category?->name ?? 'Sin categoria' }}</x-badge></td>
                        <td class="px-4 py-3">
                            <x-badge :color="$item->status === 'published' ? 'primary' : 'neutral'">
                                {{ $item->status }}
                            </x-badge>
                        </td>
                        <td class="px-4 py-3 text-right">
                            @can('editar_revistas')
                                <a href="{{ route('admin.journals.edit', $item) }}" class="mr-3 text-sm font-semibold text-primary-700 hover:underline">Editar</a>
                            @endcan
                            @can('eliminar_revistas')
                                <button wire:click="delete({{ $item->id }})" wire:confirm="¿Eliminar este registro?" class="text-sm font-semibold text-red-600 hover:underline">Eliminar</button>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-6 text-center text-slate-400">Sin registros todavia.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $items->links() }}</div>
</div>
