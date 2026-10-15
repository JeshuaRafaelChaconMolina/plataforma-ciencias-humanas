<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function mount()
    {
        abort_unless(auth()->user()->can('ver_usuarios'), 403);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function changeRole(int $userId, string $role): void
    {
        abort_unless(auth()->user()->can('editar_usuarios'), 403);
        abort_unless(Role::where('name', $role)->exists(), 422);

        $user = User::findOrFail($userId);

        if ($user->id === auth()->id()) {
            session()->flash('error', 'No puedes cambiar tu propio rol.');
            return;
        }

        $user->syncRoles([$role]);
        session()->flash('success', "Rol de {$user->name} actualizado a {$role}.");
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('name', 'ilike', "%{$this->search}%")
                    ->orWhere('email', 'ilike', "%{$this->search}%");
            }))
            ->with('roles')
            ->latest()
            ->paginate(10);

        $roles = Role::orderBy('name')->pluck('name');

        return view('livewire.admin.users.index', compact('users', 'roles'))
            ->layout('layouts.app', ['title' => 'Usuarios']);
    }
}