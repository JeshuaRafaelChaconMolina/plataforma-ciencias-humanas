<div class="max-w-2xl space-y-6">
    {{-- Navegación superior / volver --}}
    <div>
        <a href="{{ route('admin.categories.index') }}"
           class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary-700 transition">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            <span>Volver a Categorías</span>
        </a>
    </div>

    {{-- Tarjeta de formulario --}}
    <div class="rounded-3xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-sm">
        <div class="pb-6 border-b border-slate-100">
            <h2 class="text-xl font-black text-slate-900">
                {{ isset($category) ? 'Editar Categoría' : 'Nueva Categoría' }}
            </h2>
            <p class="mt-1 text-xs text-slate-500">
                Ingresa el nombre y el tipo de contenido al que aplicará esta clasificación.
            </p>
        </div>

        <form wire:submit="save" class="mt-6 space-y-5">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Nombre de la Categoría</label>
                <input type="text"
                       wire:model="name"
                       placeholder="ej. Filosofía Contemporánea"
                       class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                @error('name') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Tipo de Contenido Aplicable</label>
                <select wire:model="type"
                        class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                    <option value="general">General (aplica a todos los contenidos)</option>
                    <option value="article">Artículos de investigación</option>
                    <option value="book">Libros</option>
                    <option value="journal">Revistas científicas</option>
                    <option value="website">Sitios web</option>
                    <option value="course">Cursos</option>
                    <option value="diploma">Diplomados</option>
                    <option value="workshop">Talleres</option>
                </select>
                @error('type') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Descripción (opcional)</label>
                <textarea wire:model="description"
                          rows="3"
                          placeholder="Describe brevemente el alcance de esta categoría..."
                          class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600"></textarea>
                @error('description') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-700 px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-primary-800">
                    <span>Guardar Categoría</span>
                </button>
                <a href="{{ route('admin.categories.index') }}"
                   class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
