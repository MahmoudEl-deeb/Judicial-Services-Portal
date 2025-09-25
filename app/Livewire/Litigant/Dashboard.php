<?php

namespace App\Livewire\Litigant;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.litigant.dashboard')->layout('layouts.app');
    }
}
