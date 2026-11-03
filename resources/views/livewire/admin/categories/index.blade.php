<div class="space-y-6">
    {{-- Encabezado del Módulo --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200">
        <div>
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary-700 mb-1">
                <span class="h-1.5 w-6 rounded-full bg-accent-500"></span>
                <span>Clasificación y Taxonomía</span>
            </div>
            <h2 class="text-2xl font-black tracking-tight text-slate-900">Categorías Temáticas</h2>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Organiza las publicaciones del repositorio y la oferta educativa en áreas de conocimiento.
            </p>
        </div>

        @can('crear_categorias')
            <a href="{{ route('admin.categories.create') }}"
               class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-primary-800">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Nueva Categoría</span>
            </a>
        @endcan
    </div>

    @if(session('status'))
        <div class="flex items-center gap-3 rounded-2xl bg-emerald-50 border border-emerald-200/80 px-4 py-3 text-sm text-emerald-800 shadow-sm">
            <svg class="h-5 w-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span class="font-medium">{{ session('status') }}</span>
        </div>
    @endif

    {{-- Buscador --}}
    <div class="flex items-center justify-between gap-4">
        <div class="relative w-full max-w-md">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   placeholder="Buscar categoría por nombre..."
                   class="w-full rounded-xl border-slate-200 pl-10 pr-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-primary-600 focus:ring-primary-600">
        </div>
    </div>

    {{-- Tabla de Categorías --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-slate-200 bg-slate-50/70 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-5 py-3.5">Nombre</th>
                    <th class="px-5 py-3.5">Tipo de Contenido</th>
                    <th class="px-5 py-3.5">Descripción</th>
                    <th class="px-5 py-3.5 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($categories as $category)
                    <tr wire:key="category-{{ $category->id }}" class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-5 py-4 font-bold text-slate-900">
                            {{ $category->name }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-primary-50 border border-primary-200/80 px-2.5 py-0.5 text-xs font-semibold text-primary-800">
                                <span class="h-1.5 w-1.5 rounded-full bg-primary-600"></span>
                                {{ ucfirst($category->type ?? 'General') }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-xs text-slate-500 max-w-xs truncate">
                            {{ $category->description ?? 'Sin descripción adicional' }}
                        </td>
                        <td class="px-5 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                @can('editar_categorias')
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-2.5 py-1 text-xs font-semibold text-slate-700 hover:border-primary-400 hover:text-primary-700 transition">
                                        Editar
                                    </a>
                                @endcan
                                @can('eliminar_categorias')
                                    <button wire:click="delete({{ $category->id }})"
                                            wire:confirm="¿Seguro que deseas eliminar esta categoría?"
                                            class="inline-flex items-center gap-1 rounded-lg border border-red-200 px-2.5 py-1 text-xs font-semibold text-red-600 hover:bg-red-50 transition">
                                        Eliminar
                                    </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-12 text-center">
                            <p class="text-sm font-semibold text-slate-700">Sin categorías registradas</p>
                            <p class="text-xs text-slate-400 mt-1">Crea tu primera categoría usando el botón superior.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
