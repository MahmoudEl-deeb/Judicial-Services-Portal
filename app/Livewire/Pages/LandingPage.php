<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

// #[Layout('layouts.guest')]
class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.pages.landing-page')
        ->layout('layouts.app');
    }
}
