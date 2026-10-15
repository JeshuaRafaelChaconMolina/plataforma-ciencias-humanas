<div>
    <h2 class="section-title text-2xl">Bienvenido, {{ auth()->user()->name }}</h2>
    <div class="accent-stripe my-3"></div>
    <p class="mb-8 text-sm text-slate-500">
        Usa el menú lateral para administrar el portal.
    </p>

    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
        @foreach($metrics as $label => $value)
            <div class="card">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">{{ ucfirst(str_replace('_', ' ', $label)) }}</p>
                <p class="mt-1 text-3xl font-extrabold text-primary-700">{{ $value }}</p>
            </div>
        @endforeach
    </div>
</div>