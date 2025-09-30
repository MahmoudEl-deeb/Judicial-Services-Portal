<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

#[Layout('layouts.dash')]
class Users extends Component
{
    use WithPagination;

    public $name = '';
    public $status = '';
    public $role = '';

    public function updatedName()
    {
        $this->resetPage();
    }

    public function updatedStatus()
    {
        $this->resetPage();
    }

    public function updatedRole()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->when($this->name, function ($query, $name) {
                $query->where(function ($query) use ($name) {
                    $query->whereRaw('LOWER(first_name) LIKE ?', ["%".strtolower($name)."%"])
                          ->orWhereRaw('LOWER(last_name) LIKE ?', ["%".strtolower($name)."%"]);
                });
            })
            ->when($this->status, fn ($query, $status) => $query->where('status', $status))
            ->when($this->role, fn ($query, $role) => $query->role($role))
            ->simplePaginate(10);

        $roles = Role::all();

        return view('livewire.admin.users', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
}
