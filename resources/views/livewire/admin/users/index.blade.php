<div>
    <div class="mb-4 flex items-center justify-between">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar por nombre o correo..."
               class="w-full max-w-sm rounded-lg border-slate-200 text-sm">
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-100 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Correo</th>
                    <th class="px-4 py-3">Rol</th>
                    <th class="px-4 py-3">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $user)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-700">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $user->email }}</td>
                        <td class="px-4 py-3"><x-badge>{{ $user->roles->pluck('name')->join(', ') ?: 'Sin rol' }}</x-badge></td>
                        <td class="px-4 py-3 text-slate-500">{{ $user->status }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-6 text-center text-slate-400">Sin usuarios registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $users->links() }}</div>

    <p class="mt-6 text-xs text-slate-400">
        El formulario de creacion/edicion de usuarios y asignacion de roles se habilita en Fase 2, segun el plan acordado.
    </p>
</div>
