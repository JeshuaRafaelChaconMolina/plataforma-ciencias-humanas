<div>
    <a href="{{ route('admin.websites.index') }}" class="mb-4 inline-block text-sm text-slate-500 hover:text-primary-700">&larr; Volver al listado</a>

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
            <textarea wire:model="description" rows="5" class="w-full rounded-lg border-slate-200 text-sm"></textarea>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">URL del sitio</label>
            <input type="text" wire:model="url" placeholder="https://" class="w-full rounded-lg border-slate-200 text-sm">
            @error('url') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Estado</label>
            <select wire:model="status" class="w-full rounded-lg border-slate-200 text-sm">
                <option value="draft">Borrador</option>
                <option value="published">Publicado</option>
            </select>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="btn-primary">Guardar</button>
            <a href="{{ route('admin.websites.index') }}" class="text-sm text-slate-500 hover:text-primary-700">Cancelar</a>
        </div>
    </form>
</div>
