<div>
    <a href="{{ route('admin.courses.index') }}" class="mb-4 inline-block text-sm text-slate-500 hover:text-primary-700">&larr; Volver al listado</a>

    <form wire:submit="save" class="mt-4 max-w-3xl space-y-5">
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Título</label>
            <input type="text" wire:model="title" class="w-full rounded-lg border-slate-200 text-sm">
            @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Categoría</label>
            <select wire:model="category_id" class="w-full rounded-lg border-slate-200 text-sm">
                <option value="">Sin categoría</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Descripción</label>
            <textarea wire:model="description" rows="4" class="w-full rounded-lg border-slate-200 text-sm"></textarea>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Propósito</label>
            <textarea wire:model="purpose" rows="3" class="w-full rounded-lg border-slate-200 text-sm"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Duración</label>
                <input type="text" wire:model="duration" placeholder="ej. 40 horas" class="w-full rounded-lg border-slate-200 text-sm">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Modalidad</label>
                <input type="text" wire:model="modality" placeholder="Presencial, en linea, mixta" class="w-full rounded-lg border-slate-200 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Fecha de inicio</label>
                <input type="date" wire:model="start_date" class="w-full rounded-lg border-slate-200 text-sm">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Fecha de fin</label>
                <input type="date" wire:model="end_date" class="w-full rounded-lg border-slate-200 text-sm">
                @error('end_date') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Estado</label>
            <select wire:model="status" class="w-full rounded-lg border-slate-200 text-sm">
                <option value="draft">Borrador</option>
                <option value="published">Publicado</option>
                <option value="archived">Archivado</option>
            </select>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Imagen del curso</label>
            @if($existingImage)
                <img src="{{ asset('storage/' . $existingImage) }}" alt="Imagen actual" class="mb-2 h-32 w-48 rounded-lg object-cover">
                <p class="mb-1 text-xs text-slate-500">Imagen actual guardada. Sube una nueva para reemplazarla.</p>
            @endif
            <input type="file" wire:model="image" accept="image/*" class="w-full text-sm">
            @error('image') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            <div wire:loading wire:target="image" class="mt-1 text-xs text-slate-400">Subiendo imagen...</div>
        </div>

        <div class="rounded-xl border border-slate-100 p-4">
            <div class="mb-3 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-primary-800">Módulos del curso</h3>
                <button type="button" wire:click="addModule" class="text-xs font-semibold text-primary-700 hover:underline">+ Agregar módulo</button>
            </div>

            @forelse($modules as $index => $module)
                <div wire:key="module-{{ $index }}" class="mb-3 flex items-start gap-2 rounded-lg bg-slate-50 p-3">
                    <div class="flex-1 space-y-2">
                        <input type="text" wire:model="modules.{{ $index }}.title" placeholder="Título del módulo"
                                class="w-full rounded-lg border-slate-200 text-sm">
                        @error("modules.$index.title") <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                        <textarea wire:model="modules.{{ $index }}.description" rows="2" placeholder="Descripción (opcional)"
                                class="w-full rounded-lg border-slate-200 text-sm"></textarea>
                    </div>
                    <button type="button" wire:click="removeModule({{ $index }})" class="text-xs font-semibold text-red-600 hover:underline">Quitar</button>
                </div>
            @empty
                <p class="text-xs text-slate-400">Aún no hay módulos agregados.</p>
            @endforelse
        </div>

        <div class="rounded-xl border border-slate-100 p-4">
            <h3 class="mb-3 text-sm font-semibold text-primary-800">Vínculo con Moodle</h3>
            <label class="mb-1 block text-sm font-medium text-slate-700">URL del curso en Moodle</label>
            <input type="text" wire:model="moodle_url" placeholder="https://moodle.tudominio.edu.mx/course/view.php?id=..." class="w-full rounded-lg border-slate-200 text-sm">
            @error('moodle_url') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror

            <label class="mt-3 flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" wire:model="moodle_is_active" class="rounded border-slate-300">
                Mostrar el botón "Ingresar al curso" en el portal público
            </label>
            <p class="mt-2 text-xs text-slate-400">Si Moodle aún no está instalado, puedes dejar este campo vacío; el botón simplemente no aparecerá en la ficha pública.</p>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="btn-primary">Guardar</button>
            <a href="{{ route('admin.courses.index') }}" class="text-sm text-slate-500 hover:text-primary-700">Cancelar</a>
        </div>
    </form>
</div>
