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

    public function getStatistics()
    {
        return [
            'totalUsers' => User::count(),
            'activeUsers' => User::where('status', 'active')->count(),
            'pendingUsers' => User::where('status', 'pending')->count(),
            'suspendedUsers' => User::where('status', 'suspended')->count(),
            'lawyerUsers' => User::role('lawyer')->count(),
            'clientUsers' => User::role('litigant')->count(),
            'adminUsers' => User::role('admin')->count(),
        ];
    }

    public function getRolesWithArabic()
    {
        return [
            'admin' => 'مسؤول',
            'lawyer' => 'محامي',
            'client' => 'عميل',
            'user' => 'مستخدم',
            'moderator' => 'مشرف',
        ];
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
            ->with('roles')
            ->paginate(10);

        $roles = Role::all();
        $statistics = $this->getStatistics();
        $arabicRoles = $this->getRolesWithArabic();

        return view('livewire.admin.users', [
            'users' => $users,
            'roles' => $roles,
            'statistics' => $statistics,
            'arabicRoles' => $arabicRoles,
        ]);
    }
}