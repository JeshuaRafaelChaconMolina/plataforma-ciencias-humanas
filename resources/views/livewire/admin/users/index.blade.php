<div>
    @if (session('success'))
        <div class="mb-4 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
    @endif

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
                    @php $current = $user->roles->first()?->name; @endphp
                    <tr wire:key="user-{{ $user->id }}">
                        <td class="px-4 py-3 font-medium text-slate-700">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            <select wire:change="changeRole({{ $user->id }}, $event.target.value)"
                                    @disabled($user->id === auth()->id())
                                    class="rounded-lg border-slate-200 py-1.5 text-sm disabled:bg-slate-50 disabled:text-slate-400">
                                @unless($current)
                                    <option value="" selected disabled>Sin rol</option>
                                @endunless
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" @selected($current === $role)>{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-4 py-3 text-slate-500">{{ $user->status }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-6 text-center text-slate-400">Sin usuarios registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $users->links() }}</div>
</div>