<div>
    <a href="{{ route('admin.diplomas.index') }}" class="mb-4 inline-block text-sm text-slate-500 hover:text-primary-700">&larr; Volver al listado</a>

    <form wire:submit="save" class="mt-4 max-w-2xl space-y-5">
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
                <input type="text" wire:model="duration" class="w-full rounded-lg border-slate-200 text-sm">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Modalidad</label>
                <input type="text" wire:model="modality" class="w-full rounded-lg border-slate-200 text-sm">
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
            <label class="mb-1 block text-sm font-medium text-slate-700">Imagen del diplomado</label>
            @if($existingImage)
                <img src="{{ asset('storage/' . $existingImage) }}" alt="Imagen actual" class="mb-2 h-32 w-48 rounded-lg object-cover">
                <p class="mb-1 text-xs text-slate-500">Imagen actual guardada. Sube una nueva para reemplazarla.</p>
            @endif
            <input type="file" wire:model="image" class="w-full text-sm">
            @error('image') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            <div wire:loading wire:target="image" class="mt-1 text-xs text-slate-400">Subiendo imagen...</div>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="btn-primary">Guardar</button>
            <a href="{{ route('admin.diplomas.index') }}" class="text-sm text-slate-500 hover:text-primary-700">Cancelar</a>
        </div>
    </form>
</div>
