<div class="space-y-6">
    {{-- Encabezado del Módulo --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200">
        <div>
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary-700 mb-1">
                <span class="h-1.5 w-6 rounded-full bg-accent-500"></span>
                <span>Oferta Educativa</span>
            </div>
            <h2 class="text-2xl font-black tracking-tight text-slate-900">Talleres Prácticos y Seminarios</h2>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Espacios formativos de corta duración enfocados en destrezas metodológicas, análisis y praxis humanística.
            </p>
        </div>

        @can('crear_talleres')
            <a href="{{ route('admin.workshops.create') }}"
               class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-primary-800">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Nuevo Taller</span>
            </a>
        @endcan
    </div>

    {{-- Notificación de estado --}}
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
                   placeholder="Buscar taller o seminario..."
                   class="w-full rounded-xl border-slate-200 pl-10 pr-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-primary-600 focus:ring-primary-600">
        </div>
    </div>

    {{-- Tabla de Talleres --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-slate-200 bg-slate-50/70 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-5 py-3.5">Taller y Modalidad</th>
                    <th class="px-5 py-3.5">Categoría</th>
                    <th class="px-5 py-3.5">Fechas</th>
                    <th class="px-5 py-3.5">Estado</th>
                    <th class="px-5 py-3.5 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($items as $item)
                    <tr wire:key="workshop-{{ $item->id }}" class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-5 py-4">
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700 font-bold text-xs">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.67 2.67 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.07a4.5 4.5 0 0 0 4.486-6.32l-3.27 3.287a1.5 1.5 0 0 1-2.122-2.122l3.288-3.27a4.5 4.5 0 0 0-6.32 4.486c.118.58.094 1.193-.07 1.743" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <span class="block font-bold text-slate-900 leading-snug">{{ $item->title }}</span>
                                    <div class="mt-1 flex flex-wrap items-center gap-2 text-xs text-slate-500">
                                        @if($item->modality)
                                            <span class="font-medium text-slate-700">{{ $item->modality }}</span>
                                        @endif
                                        @if($item->duration)
                                            <span class="text-slate-400">• {{ $item->duration }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-primary-50 border border-primary-200/80 px-2.5 py-0.5 text-xs font-semibold text-primary-800">
                                <span class="h-1.5 w-1.5 rounded-full bg-primary-600"></span>
                                {{ $item->category?->name ?? 'Sin categoría' }}
                            </span>
                        </td>

                        <td class="px-5 py-4 text-xs text-slate-500">
                            @if($item->start_date)
                                <span>{{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }}</span>
                                @if($item->end_date)
                                    <span class="text-slate-400"> al {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}</span>
                                @endif
                            @else
                                <span class="text-slate-400">Por definir</span>
                            @endif
                        </td>

                        <td class="px-5 py-4">
                            @if($item->status === 'published')
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 border border-emerald-200 px-2.5 py-0.5 text-xs font-semibold text-emerald-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    Publicado
                                </span>
                            @elseif($item->status === 'draft')
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 border border-amber-200 px-2.5 py-0.5 text-xs font-semibold text-amber-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    Borrador
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 border border-slate-200 px-2.5 py-0.5 text-xs font-semibold text-slate-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                    Archivado
                                </span>
                            @endif
                        </td>

                        <td class="px-5 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                @can('editar_talleres')
                                    <a href="{{ route('admin.workshops.edit', $item) }}"
                                       class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-2.5 py-1 text-xs font-semibold text-slate-700 hover:border-primary-400 hover:text-primary-700 transition">
                                        Editar
                                    </a>
                                @endcan
                                @can('eliminar_talleres')
                                    <button wire:click="delete({{ $item->id }})"
                                            wire:confirm="¿Seguro que deseas eliminar este taller?"
                                            class="inline-flex items-center gap-1 rounded-lg border border-red-200 px-2.5 py-1 text-xs font-semibold text-red-600 hover:bg-red-50 transition">
                                        Eliminar
                                    </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400 mb-3">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.67 2.67 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.07a4.5 4.5 0 0 0 4.486-6.32l-3.27 3.287a1.5 1.5 0 0 1-2.122-2.122l3.288-3.27a4.5 4.5 0 0 0-6.32 4.486c.118.58.094 1.193-.07 1.743" />
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-700">Sin talleres registrados</p>
                            <p class="text-xs text-slate-400 mt-1">Registra talleres prácticos y seminarios interactivos.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $items->links() }}
    </div>
</div>
