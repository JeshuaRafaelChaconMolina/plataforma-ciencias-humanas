<div class="space-y-8">
    {{-- Encabezado del Módulo --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200">
        <div>
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary-700 mb-1">
                <span class="h-1.5 w-6 rounded-full bg-accent-500"></span>
                <span>Analítica y Monitoreo</span>
            </div>
            <h2 class="text-2xl font-black tracking-tight text-slate-900">Métricas y Estadísticas del Sistema</h2>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Resumen cuantitativo del repositorio digital, programas de educación continua y estado de publicaciones.
            </p>
        </div>
    </div>

    {{-- Tarjetas KPI de Resumen General --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Usuarios --}}
        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Usuarios Registrados</span>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-50 text-primary-700">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-3xl font-black text-slate-900 tracking-tight">{{ $summary['Usuarios'] ?? 0 }}</p>
            <p class="mt-1 text-xs text-slate-500 font-medium">Cuentas activas en la plataforma</p>
        </div>

        {{-- Contenido Total --}}
        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total de Recursos</span>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-700">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-3xl font-black text-primary-700 tracking-tight">{{ $summary['Contenido total'] ?? 0 }}</p>
            <p class="mt-1 text-xs text-slate-500 font-medium">Elementos registrados en catálogo</p>
        </div>

        {{-- Publicados --}}
        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Publicados en Línea</span>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-3xl font-black text-emerald-600 tracking-tight">{{ $summary['Publicados'] ?? 0 }}</p>
            <p class="mt-1 text-xs text-slate-500 font-medium">Visibles para alumnos y docentes</p>
        </div>

        {{-- Borradores --}}
        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">En Edición / Borrador</span>
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-700">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-3xl font-black text-amber-600 tracking-tight">{{ $summary['Borradores'] ?? 0 }}</p>
            <p class="mt-1 text-xs text-slate-500 font-medium">Pendientes de publicación</p>
        </div>
    </div>

    {{-- Tabla de Desglose por Módulo --}}
    <div class="space-y-4">
        <div>
            <h3 class="text-lg font-black text-slate-900 tracking-tight">Distribución por Módulo Académico</h3>
            <p class="text-xs text-slate-500">Detalle de existencias, publicaciones activas y elementos en preparación.</p>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-200 bg-slate-50/70 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-5 py-3.5">Módulo Académico</th>
                        <th class="px-5 py-3.5 text-center">Total</th>
                        <th class="px-5 py-3.5 text-center">Publicados</th>
                        <th class="px-5 py-3.5 text-center">Borradores</th>
                        <th class="px-5 py-3.5 text-center">Archivados</th>
                        <th class="px-5 py-3.5 text-right">Porcentaje Activo</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($rows as $row)
                        @php
                            $rate = $row['total'] > 0 && $row['published'] !== null
                                ? round(($row['published'] / $row['total']) * 100)
                                : 0;
                        @endphp
                        <tr wire:key="metric-{{ $row['label'] }}" class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-5 py-4 font-bold text-slate-900">
                                <div class="flex items-center gap-2.5">
                                    <span class="h-2 w-2 rounded-full bg-primary-600"></span>
                                    <span>{{ $row['label'] }}</span>
                                </div>
                            </td>

                            <td class="px-5 py-4 text-center font-bold text-slate-900">
                                <span class="inline-flex items-center justify-center rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-black text-slate-700">
                                    {{ $row['total'] }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">
                                @if($row['published'] !== null)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 border border-emerald-200/80 px-2 py-0.5 text-xs font-semibold text-emerald-700">
                                        {{ $row['published'] }}
                                    </span>
                                @else
                                    <span class="text-slate-300 font-mono text-xs">—</span>
                                @endif
                            </td>

                            <td class="px-5 py-4 text-center">
                                @if($row['draft'] !== null)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 border border-amber-200/80 px-2 py-0.5 text-xs font-semibold text-amber-700">
                                        {{ $row['draft'] }}
                                    </span>
                                @else
                                    <span class="text-slate-300 font-mono text-xs">—</span>
                                @endif
                            </td>

                            <td class="px-5 py-4 text-center">
                                @if($row['archived'] !== null && $row['archived'] > 0)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 border border-slate-200 px-2 py-0.5 text-xs font-semibold text-slate-600">
                                        {{ $row['archived'] }}
                                    </span>
                                @else
                                    <span class="text-slate-300 font-mono text-xs">0</span>
                                @endif
                            </td>

                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <div class="w-20 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-primary-700 h-1.5 rounded-full" style="width: {{ $rate }}%"></div>
                                    </div>
                                    <span class="font-mono text-xs font-bold text-slate-600 w-9 text-right">{{ $rate }}%</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Nota informativa institucional --}}
    <div class="flex items-start gap-3 rounded-2xl border border-primary-200/60 bg-primary-50/50 p-4 text-xs text-primary-900 shadow-sm">
        <svg class="h-5 w-5 text-primary-700 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
        </svg>
        <div>
            <span class="font-bold block">Monitoreo y Métricas Institucionales</span>
            <span class="text-slate-600 mt-0.5 block">
                Las métricas cuantitativas corresponden a los registros almacenados en la base de datos institucional. El módulo de analítica de tráfico web e interacciones en tiempo real se vinculará de acuerdo con los lineamientos de privacidad institucional.
            </span>
        </div>
    </div>
</div>