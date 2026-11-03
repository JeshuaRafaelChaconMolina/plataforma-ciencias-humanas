<div class="max-w-4xl space-y-6">
    {{-- Navegación superior / volver --}}
    <div>
        <a href="{{ route('admin.workshops.index') }}"
           class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary-700 transition">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            <span>Volver a Talleres</span>
        </a>
    </div>

    {{-- Tarjeta de formulario --}}
    <div class="rounded-3xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-sm">
        <div class="pb-6 border-b border-slate-100">
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary-700 mb-1">
                <span class="h-1.5 w-6 rounded-full bg-accent-500"></span>
                <span>Oferta Educativa</span>
            </div>
            <h2 class="text-xl font-black text-slate-900">
                {{ $workshop ? 'Editar Taller' : 'Nuevo Taller o Seminario Práctico' }}
            </h2>
            <p class="mt-1 text-xs text-slate-500">
                Define los objetivos aplicados, temporalidad e imagen del taller para la comunidad universitaria.
            </p>
        </div>

        <form wire:submit="save" class="mt-6 space-y-6">
            {{-- Datos Generales --}}
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary-100 text-primary-800 text-xs font-black">1</span>
                    <span>Información del Taller</span>
                </h3>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Título del Taller</label>
                    <input type="text"
                           wire:model="title"
                           placeholder="ej. Metodologías Cualitativas y Análisis del Discurso"
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

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Descripción y Dinámica de Trabajo</label>
                    <textarea wire:model="description"
                              rows="3"
                              placeholder="Resumen del taller, dinámicas prácticas y metodología aplicada..."
                              class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600"></textarea>
                    @error('description') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Propósito y Resultados Esperados</label>
                    <textarea wire:model="purpose"
                              rows="2"
                              placeholder="Destrezas que los participantes desarrollarán al finalizar el taller..."
                              class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600"></textarea>
                    @error('purpose') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Duración, Calendario y Visibilidad --}}
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary-100 text-primary-800 text-xs font-black">2</span>
                    <span>Duración, Modalidad y Periodo</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Duración Estimada</label>
                        <input type="text"
                               wire:model="duration"
                               placeholder="ej. 20 horas en 4 sesiones"
                               class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                        @error('duration') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Modalidad</label>
                        <input type="text"
                               wire:model="modality"
                               placeholder="Presencial / Virtual sincrónico"
                               class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                        @error('modality') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Fecha de Inicio</label>
                        <input type="date"
                               wire:model="start_date"
                               class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                        @error('start_date') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Fecha de Cierre</label>
                        <input type="date"
                               wire:model="end_date"
                               class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                        @error('end_date') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Estado de Publicación</label>
                        <select wire:model="status"
                                class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                            <option value="draft">Borrador</option>
                            <option value="published">Publicado</option>
                            <option value="archived">Archivado</option>
                        </select>
                        @error('status') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Imagen Promocional --}}
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-primary-100 text-primary-800 text-xs font-black">3</span>
                    <span>Imagen Promocional</span>
                </h3>

                <div class="rounded-2xl border border-dashed border-slate-300 p-5 bg-slate-50/50">
                    @if($existingImage)
                        <div class="mb-4 flex items-center gap-4">
                            <img src="{{ asset('storage/' . $existingImage) }}" alt="Portada actual" class="h-20 w-32 rounded-xl object-cover shadow-sm border border-slate-200">
                            <div>
                                <span class="text-xs font-bold text-slate-800 block">Imagen actual guardada</span>
                                <span class="text-xs text-slate-500">Para reemplazarla, selecciona un archivo nuevo debajo.</span>
                            </div>
                        </div>
                    @endif

                    <input type="file" wire:model="image" accept="image/*"
                           class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition">
                    @error('image') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror

                    <div wire:loading wire:target="image" class="mt-2 flex items-center gap-2 text-xs text-primary-700 font-medium">
                        <svg class="animate-spin h-3.5 w-3.5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Cargando imagen promocional...</span>
                    </div>
                </div>
            </div>

            {{-- Botones de Acción --}}
            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-700 px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-primary-800">
                    <span>Guardar Taller</span>
                </button>
                <a href="{{ route('admin.workshops.index') }}"
                   class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
