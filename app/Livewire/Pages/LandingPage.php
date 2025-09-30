<?php

namespace App\Livewire\Pages;

use App\Models\ServiceType;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class LandingPage extends Component
{
    public function render()
    {
        $services = ServiceType::all();
        return view('livewire.pages.landing-page', compact('services'));
    }
}
