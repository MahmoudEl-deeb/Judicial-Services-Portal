<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.dash')]
class UserDetails extends Component
{
    public User $user;
    public $status; // Separate property for the status
    public $statuses = ['active', 'inactive', 'suspended', 'pending'];

    public function mount(User $user)
    {
        // Load the user with lawyer relationship if it exists
        $this->user = $user->load('lawyer');
        
        // Initialize the status property with the user's current status
        $this->status = $this->user->status;
    }

    public function updateUserStatus()
    {
        $this->validate([
            'status' => 'required|in:active,inactive,suspended,pending',
        ]);

        try {
            // Update the user's status
            $this->user->status = $this->status;
            $this->user->save();
            
            // Refresh the user model to get the updated data
            $this->user->refresh();
            
            session()->flash('message', 'User status updated successfully.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update user status: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.user-details');
    }
}