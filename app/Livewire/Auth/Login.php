<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;

#[Layout('layouts.guest')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    public function rules()
    {

        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    public function login()
    {

        try{
        Log::info('Login method called.');

        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => __('The provided credentials are incorrect.'),
            ]);
        }

        session()->regenerate();

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user) {
            return redirect()->intended($user->getDashboardRoute());
        }} catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            throw $e; // Re-throw the exception after logging it
        }
        
        return redirect()->route('login');
    }

    public function render()
    {
            // dd(vars: 'This component is loading - check routes and cache');

        return view('livewire.auth.login');
    }
}