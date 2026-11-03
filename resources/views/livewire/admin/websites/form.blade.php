<div class="max-w-3xl space-y-6">
    {{-- Navegación superior / volver --}}
    <div>
        <a href="{{ route('admin.websites.index') }}"
           class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary-700 transition">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            <span>Volver a Sitios Web</span>
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
                {{ $website ? 'Editar Recurso Web' : 'Nuevo Sitio Web o Recurso Externo' }}
            </h2>
            <p class="mt-1 text-xs text-slate-500">
                Registra la URL y propósito de una plataforma, repositorio externo o base de datos recomendada.
            </p>
        </div>

        <form wire:submit="save" class="mt-6 space-y-5">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Nombre del Portal o Recurso</label>
                <input type="text"
                       wire:model="title"
                       placeholder="ej. Redalyc - Red de Revistas Científicas de América Latina"
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
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Dirección Web (URL Completa)</label>
                <div class="relative mt-1.5">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                        </svg>
                    </div>
                    <input type="text"
                           wire:model="url"
                           placeholder="https://www.redalyc.org"
                           class="w-full rounded-xl border-slate-200 pl-10 pr-4 py-2.5 text-sm font-mono shadow-sm focus:border-primary-600 focus:ring-primary-600">
                </div>
                @error('url') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Descripción / Contenido Disponible</label>
                <textarea wire:model="description"
                          rows="4"
                          placeholder="Indica qué tipo de acervo, herramientas o colecciones ofrece este sitio a los investigadores..."
                          class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600"></textarea>
                @error('description') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Estado de Publicación</label>
                <select wire:model="status"
                        class="mt-1.5 w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm shadow-sm focus:border-primary-600 focus:ring-primary-600">
                    <option value="draft">Borrador (oculto en portal público)</option>
                    <option value="published">Publicado (visible en directorio de sitios)</option>
                </select>
                @error('status') <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-700 px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-primary-800">
                    <span>Guardar Recurso</span>
                </button>
                <a href="{{ route('admin.websites.index') }}"
                   class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
