<div class="space-y-6">
    {{-- Encabezado del Módulo --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200">
        <div>
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary-700 mb-1">
                <span class="h-1.5 w-6 rounded-full bg-accent-500"></span>
                <span>Oferta Educativa</span>
            </div>
            <h2 class="text-2xl font-black tracking-tight text-slate-900">Cursos de Formación Continua</h2>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Catálogo de cursos académicos, temarios modulares y vinculación directa con el aula virtual Moodle.
            </p>
        </div>

        @can('crear_cursos')
            <a href="{{ route('admin.courses.create') }}"
               class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-primary-800">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Nuevo Curso</span>
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
                   placeholder="Buscar curso por nombre..."
                   class="w-full rounded-xl border-slate-200 pl-10 pr-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-primary-600 focus:ring-primary-600">
        </div>
    </div>

    {{-- Tabla de Cursos --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-slate-200 bg-slate-50/70 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-5 py-3.5">Curso y Modalidad</th>
                    <th class="px-5 py-3.5">Categoría</th>
                    <th class="px-5 py-3.5">Moodle</th>
                    <th class="px-5 py-3.5">Estado</th>
                    <th class="px-5 py-3.5 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($items as $item)
                    <tr wire:key="course-{{ $item->id }}" class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-5 py-4">
                            <div class="flex items-start gap-3">
                                <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-primary-100 text-primary-800 font-bold text-xs">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
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

                        <td class="px-5 py-4">
                            @if($item->moodleLink && $item->moodleLink->moodle_url)
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-md border border-amber-200">
                                    <svg class="h-3 w-3 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Enlazado
                                </span>
                            @else
                                <span class="text-xs text-slate-400">Sin aula</span>
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
                                @can('editar_cursos')
                                    <a href="{{ route('admin.courses.edit', $item) }}"
                                       class="inline-flex items-center gap-1 rounded-lg border border-slate-200 px-2.5 py-1 text-xs font-semibold text-slate-700 hover:border-primary-400 hover:text-primary-700 transition">
                                        Editar
                                    </a>
                                @endcan
                                @can('eliminar_cursos')
                                    <button wire:click="delete({{ $item->id }})"
                                            wire:confirm="¿Seguro que deseas eliminar este curso?"
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
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" />
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-700">Sin cursos registrados</p>
                            <p class="text-xs text-slate-400 mt-1">Crea tu primer curso para la oferta educativa continua.</p>
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
