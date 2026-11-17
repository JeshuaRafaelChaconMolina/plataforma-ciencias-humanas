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

    public function delete(int $userId): void
    {
        abort_unless(auth()->user()->can('eliminar_usuarios'), 403);

        $user = User::findOrFail($userId);

        // El admin no puede eliminarse a sí mismo.
        if ($user->id === auth()->id()) {
            session()->flash('error', 'No puedes eliminar tu propia cuenta.');
            return;
        }

        // No se puede eliminar al último administrador del sistema.
        if ($user->hasRole('administrador') && User::role('administrador')->count() <= 1) {
            session()->flash('error', 'No puedes eliminar al último administrador del sistema.');
            return;
        }

        // El contenido que el usuario creó (cursos, diplomados, talleres,
        // libros, artículos, etc.) NO se borra: sus llaves created_by son
        // nullOnDelete en la base de datos, así que solo quedan sin autor.
        // Los registros de auditoría tampoco se borran (user_id nullOnDelete).
        // Se limpian sus roles y permisos para no dejar filas huérfanas en
        // las tablas de Spatie (model_has_roles / model_has_permissions).
        // Su cuenta de Moodle, si se creó con el auto-registro, NO se borra
        // aquí: hay que eliminarla aparte en Moodle si se desea.
        $user->syncRoles([]);
        $user->syncPermissions([]);
        $user->delete();

        $this->resetPage();

        session()->flash('success', "Usuario {$user->name} eliminado correctamente.");
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