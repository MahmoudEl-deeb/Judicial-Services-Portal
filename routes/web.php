<?php

use App\Livewire\Auth\Login;
use App\Livewire\Pages\AllServices;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Register;
use App\Livewire\Lawyer\Dashboard as LawyerDashboard;
use App\Livewire\Litigant\Dashboard as LitigantDashboard;

Route::view('/', 'welcome');



Route::middleware(['auth', 'verified'])->group(function () {
    // Generic dashboard (will redirect based on role)
    Route::get('/dashboard', function () {
        return redirect(auth()->user()->getDashboardRoute());
    })->name('dashboard');
    
    // Lawyer dashboard
    Route::get('/lawyer/dashboard', LawyerDashboard::class)
        ->middleware(['role:lawyer'])
        ->name('lawyer.dashboard');
    
    // Litigant dashboard
    Route::get('/litigant/dashboard', LitigantDashboard::class)
        ->middleware(['role:litigant'])
        ->name('litigant.dashboard');
    
    // // Admin dashboard
    // Route::get('/admin/dashboard', AdminDashboard::class)
    //     ->middleware(['role:admin'])
    //     ->name('admin.dashboard');
});

// routes/web.php
Route::get('/test-email', function () {
    try {
        \Illuminate\Support\Facades\Mail::raw('Test email content', function ($message) {
            $message->to('mahmoud.eldeeb.9898@gmail.com')
                ->subject('Test Email from Laravel');
        });

        return 'Email sent successfully (or so it seems)';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/register', Register::class)
    ->middleware(['guest'])
    ->name('register');

Route::get('/login', Login::class)
    ->middleware(['guest'])
    ->name('login');
