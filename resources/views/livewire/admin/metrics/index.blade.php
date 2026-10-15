<div>
    <p class="mb-6 text-sm text-slate-500">Métricas básicas de contenido y usuarios de la plataforma.</p>

    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
        @foreach($summary as $label => $value)
            <div class="card">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">{{ $label }}</p>
                <p class="mt-1 text-3xl font-extrabold text-primary-700">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <h3 class="section-title mt-10 text-lg">Contenido por módulo</h3>
    <div class="accent-stripe my-3"></div>

    <div class="overflow-hidden rounded-xl border border-slate-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3">Módulo</th>
                    <th class="px-4 py-3 text-right">Total</th>
                    <th class="px-4 py-3 text-right">Publicados</th>
                    <th class="px-4 py-3 text-right">Borradores</th>
                    <th class="px-4 py-3 text-right">Archivados</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($rows as $row)
                    <tr wire:key="metric-{{ $row['label'] }}">
                        <td class="px-4 py-3 font-medium text-slate-700">{{ $row['label'] }}</td>
                        <td class="px-4 py-3 text-right font-semibold text-slate-700">{{ $row['total'] }}</td>
                        <td class="px-4 py-3 text-right text-slate-500">{{ $row['published'] ?? '—' }}</td>
                        <td class="px-4 py-3 text-right text-slate-500">{{ $row['draft'] ?? '—' }}</td>
                        <td class="px-4 py-3 text-right text-slate-500">{{ $row['archived'] ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <p class="mt-8 text-xs text-slate-400">
        Las métricas de visitas y tráfico del portal público se incorporarán cuando se defina la herramienta de analítica (pendiente de aprobación institucional).
    </p>
</div>