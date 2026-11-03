<div class="max-w-3xl space-y-6">
    {{-- Navegación superior / volver --}}
    <div>
        <a href="{{ route('admin.journals.index') }}"
           class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary-700 transition">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            <span>Volver a Revistas</span>
        </a>
    </div>

    {{-- Tarjeta de formulario --}}
    <div class="rounded-3xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-sm">
        <div class="pb-6 border-b border-slate-100">
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary-700 mb-1">
                <span class="h-1.5 w-6 rounded-full bg-accent-500"></span>
                <span>Repositorio Digital</span>
            </div>
            <h2 class="text-xl font-black text-slate-900">
                {{ $journal ? 'Editar Revista' : 'Nueva Revista o Publicación Periódica' }}
            </h2>
            <p class="mt-1 text-xs text-slate-500">
                Registra la edición, año y temas centrales del ejemplar para su consulta abierta.
            </p>
        </div>

        <form wire:submit="save" class="mt-6 space-y-5">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Nombre de la Revista / Publicación</label>
                <input type="text"
                       wire:model="title"
                       placeholder="ej. Cuadernos de Filosofía y Humanidades"
                       class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                @error('title') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Categoría Temática</label>
                <select wire:model="category_id"
                        class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                    <option value="">Selecciona una categoría (opcional)</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Número / Edición / Volumen</label>
                    <input type="text"
                           wire:model="edition"
                           placeholder="ej. Vol. 12 Núm. 2"
                           class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                    @error('edition') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Año de Publicación</label>
                    <input type="number"
                           wire:model="year"
                           placeholder="{{ date('Y') }}"
                           class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                    @error('year') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Editorial / Presentación / Resumen</label>
                <textarea wire:model="description"
                          rows="4"
                          placeholder="Sumario de artículos y presentación del número editorial..."
                          class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600"></textarea>
                @error('description') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Estado de Publicación</label>
                <select wire:model="status"
                        class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                    <option value="draft">Borrador (oculto en portal público)</option>
                    <option value="published">Publicado (visible en hemeroteca digital)</option>
                </select>
                @error('status') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            {{-- Adjunto / Archivo digital --}}
            <div class="rounded-2xl border border-dashed border-slate-300 p-5 bg-slate-50/50">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Archivo de la Revista (Fascículo completo en PDF)</label>
                
                @if($existingFileName)
                    <div class="mb-3 flex items-center justify-between rounded-xl bg-white border border-slate-200 p-3 text-xs">
                        <div class="flex items-center gap-2 text-slate-700 font-medium truncate">
                            <svg class="h-4 w-4 text-primary-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                            </svg>
                            <span class="truncate">{{ $existingFileName }}</span>
                        </div>
                        <a href="{{ $existingFileUrl }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-1 font-bold text-primary-700 hover:text-primary-900 transition">
                            <span>Ver archivo</span>
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                        </a>
                    </div>
                @endif

                <input type="file" wire:model="attachment"
                       class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition">
                @error('attachment') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror

                <div wire:loading wire:target="attachment" class="mt-2 flex items-center gap-2 text-xs text-primary-700 font-medium">
                    <svg class="animate-spin h-3.5 w-3.5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Subiendo fascículo al servidor...</span>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-700 px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-primary-800">
                    <span>Guardar Revista</span>
                </button>
                <a href="{{ route('admin.journals.index') }}"
                   class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
