<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function mount()
    {
        abort_unless(auth()->user()->can('ver_usuarios'), 403);
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, fn ($q) => $q->where('name', 'ilike', "%{$this->search}%")
                ->orWhere('email', 'ilike', "%{$this->search}%"))
            ->with('roles')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.users.index', compact('users'))
            ->layout('layouts.app', ['title' => 'Usuarios']);
    }
}
