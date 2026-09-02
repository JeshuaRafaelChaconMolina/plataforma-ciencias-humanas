<div>
    <a href="{{ route('admin.journals.index') }}" class="mb-4 inline-block text-sm text-slate-500 hover:text-primary-700">&larr; Volver al listado</a>

    <form wire:submit="save" class="mt-4 max-w-2xl space-y-5">
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Titulo</label>
            <input type="text" wire:model="title" class="w-full rounded-lg border-slate-200 text-sm">
            @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Categoria</label>
            <select wire:model="category_id" class="w-full rounded-lg border-slate-200 text-sm">
                <option value="">Sin categoria</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Descripcion</label>
            <textarea wire:model="description" rows="5" class="w-full rounded-lg border-slate-200 text-sm"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Edicion</label>
                <input type="text" wire:model="edition" class="w-full rounded-lg border-slate-200 text-sm">
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Anio</label>
                <input type="number" wire:model="year" class="w-full rounded-lg border-slate-200 text-sm">
            </div>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Estado</label>
            <select wire:model="status" class="w-full rounded-lg border-slate-200 text-sm">
                <option value="draft">Borrador</option>
                <option value="published">Publicado</option>
            </select>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Archivo adjunto</label>
            @if($existingFileName)
                <p class="mb-1 text-xs text-slate-500">
                    Archivo actual:
                    <a href="{{ $existingFileUrl }}" target="_blank" rel="noopener" class="font-semibold text-primary-700 hover:underline">{{ $existingFileName }}</a>
                </p>
            @endif
            <input type="file" wire:model="attachment" class="w-full text-sm">
            @error('attachment') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            <div wire:loading wire:target="attachment" class="mt-1 text-xs text-slate-400">Subiendo archivo...</div>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="btn-primary">Guardar</button>
            <a href="{{ route('admin.journals.index') }}" class="text-sm text-slate-500 hover:text-primary-700">Cancelar</a>
        </div>
    </form>
</div>
