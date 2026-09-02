<div>
    <p class="mb-6 text-sm text-slate-500">
        Resumen general de la plataforma. El CRUD completo de cada modulo se habilita en las siguientes fases.
    </p>

    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
        @foreach($metrics as $label => $value)
            <div class="card">
                <p class="text-xs uppercase tracking-wide text-slate-400">{{ str_replace('_', ' ', $label) }}</p>
                <p class="mt-1 text-3xl font-extrabold text-primary-700">{{ $value }}</p>
            </div>
        @endforeach
    </div>
</div>
