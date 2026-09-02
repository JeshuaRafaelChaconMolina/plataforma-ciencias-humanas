<div>
    <p class="mb-6 text-sm text-slate-500">Metricas basicas de contenido y usuarios de la plataforma.</p>

    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
        @foreach($data as $label => $value)
            <div class="card">
                <p class="text-xs uppercase tracking-wide text-slate-400">{{ $label }}</p>
                <p class="mt-1 text-3xl font-extrabold text-primary-700">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <p class="mt-8 text-xs text-slate-400">
        Metricas de visitas y trafico del portal publico se incorporaran cuando se defina la herramienta de analitica (pendiente de aprobacion institucional).
    </p>
</div>
