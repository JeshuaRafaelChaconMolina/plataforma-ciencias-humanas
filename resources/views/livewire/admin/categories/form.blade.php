<div>
    <a href="{{ route('admin.categories.index') }}" class="mb-4 inline-block text-sm text-slate-500 hover:text-primary-700">&larr; Volver al listado</a>

    <form wire:submit="save" class="mt-4 max-w-xl space-y-5">
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Nombre</label>
            <input type="text" wire:model="name" class="w-full rounded-lg border-slate-200 text-sm">
            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Tipo</label>
            <select wire:model="type" class="w-full rounded-lg border-slate-200 text-sm">
                <option value="general">General (aplica a todos los contenidos)</option>
                <option value="article">Artículos</option>
                <option value="book">Libros</option>
                <option value="journal">Revistas</option>
                <option value="website">Sitios web</option>
                <option value="course">Cursos</option>
                <option value="diploma">Diplomados</option>
                <option value="workshop">Talleres</option>
            </select>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Descripción</label>
            <textarea wire:model="description" rows="3" class="w-full rounded-lg border-slate-200 text-sm"></textarea>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="btn-primary">Guardar</button>
            <a href="{{ route('admin.categories.index') }}" class="text-sm text-slate-500 hover:text-primary-700">Cancelar</a>
        </div>
    </form>
</div>
