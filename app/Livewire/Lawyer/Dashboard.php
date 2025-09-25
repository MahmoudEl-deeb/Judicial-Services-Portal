<?php

namespace App\Livewire\Lawyer;

use Livewire\Component;

// #Layout[app-layout]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.lawyer.dashboard')->layout('layouts.app');
    }
}
