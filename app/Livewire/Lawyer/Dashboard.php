<?php

namespace App\Livewire\Lawyer;

use Livewire\Component;

// #Layout[app-layout]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.lawyer.dashboard')->layout('layouts.dash', [
                'links' => [
                    [
                        'url' => route('lawyer.dashboard'),
                        'label' => 'الرئيسية',
                        'icon' => 'fas fa-home',
                        'active' => 'lawyer/dashboard',
                    ],
                    [
                        'url' => route('lawyer.dashboard'),
                        'label' => 'القضايا',
                        'icon' => 'fas fa-gavel',
                        'active' => 'lawyer/cases*',
                    ],
                ],
            ]);
    }
}
