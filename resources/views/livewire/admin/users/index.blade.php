<div class="space-y-6">
    {{-- Encabezado del Módulo --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200">
        <div>
            <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-primary-700 mb-1">
                <span class="h-1.5 w-6 rounded-full bg-accent-500"></span>
                <span>Administración del Sistema</span>
            </div>
            <h2 class="text-2xl font-black tracking-tight text-slate-900">Usuarios y Asignación de Roles</h2>
            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Gestiona las cuentas registradas y cambia los permisos de acceso entre Administrador, Docente y Alumno.
            </p>
        </div>
    </div>

    {{-- Alertas de éxito y error --}}
    @if (session('success'))
        <div class="flex items-center gap-3 rounded-2xl bg-emerald-50 border border-emerald-200/80 px-4 py-3 text-sm text-emerald-800 shadow-sm">
            <svg class="h-5 w-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="flex items-center gap-3 rounded-2xl bg-red-50 border border-red-200/80 px-4 py-3 text-sm text-red-800 shadow-sm">
            <svg class="h-5 w-5 text-red-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Barra de búsqueda y filtros --}}
    <div class="flex items-center justify-between gap-4">
        <div class="relative w-full max-w-md">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   placeholder="Buscar por nombre o correo electrónico..."
                   class="w-full rounded-xl border-slate-200 pl-10 pr-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-primary-600 focus:ring-primary-600">
        </div>
    </div>

    {{-- Tabla de Usuarios --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-slate-200 bg-slate-50/70 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                <tr>
                    <th class="px-5 py-3.5">Usuario</th>
                    <th class="px-5 py-3.5">Correo Electrónico</th>
                    <th class="px-5 py-3.5">Rol en el Sistema</th>
                    <th class="px-5 py-3.5">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $user)
                    @php
                        $current = $user->roles->first()?->name;
                        $initials = strtoupper(substr($user->name, 0, 1));
                    @endphp
                    <tr wire:key="user-{{ $user->id }}" class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary-100 font-bold text-primary-800 text-xs shadow-sm">
                                    {{ $initials }}
                                </div>
                                <div>
                                    <span class="block font-bold text-slate-900">{{ $user->name }}</span>
                                    <span class="text-[11px] text-slate-400">ID: #{{ $user->id }}</span>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-4 font-mono text-xs text-slate-600">
                            {{ $user->email }}
                        </td>

                        <td class="px-5 py-4">
                            <select wire:change="changeRole({{ $user->id }}, $event.target.value)"
                                    @disabled($user->id === auth()->id())
                                    class="rounded-xl border-slate-200 bg-white py-1.5 px-3 text-xs font-semibold shadow-sm focus:border-primary-600 focus:ring-primary-600 disabled:bg-slate-50 disabled:text-slate-400">
                                @unless($current)
                                    <option value="" selected disabled>Sin rol asignado</option>
                                @endunless
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" @selected($current === $role)>{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 border border-emerald-200 px-2.5 py-0.5 text-xs font-semibold text-emerald-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                {{ ucfirst($user->status ?? 'Activo') }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-12 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400 mb-3">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="9" cy="8" r="3" /><path stroke-linecap="round" stroke-linejoin="round" d="M3.5 20a5.5 5.5 0 0 1 11 0" />
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-700">No se encontraron usuarios</p>
                            <p class="text-xs text-slate-400 mt-1">Prueba con otro término de búsqueda.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>