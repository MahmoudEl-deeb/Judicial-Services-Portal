<?php

use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Auth\Login;
use App\Livewire\Pages\AllServices;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Register;
use App\Livewire\Lawyer\Dashboard as LawyerDashboard;
use App\Livewire\Litigant\Dashboard as LitigantDashboard;
use App\Livewire\Pages\CreateService;
use App\Livewire\Pages\LandingPage;

Route::get('/', LandingPage::class)->name('home');



Route::middleware(['auth', 'verified'])->group(function () {
    // Generic dashboard (will redirect based on role)
    Route::get('/dashboard', function () {
        /** @var \App\Models\User $user */
        $user = Illuminate\Support\Facades\Auth::user();
        if ($user) {
            return redirect($user->getDashboardRoute());
        }
        return redirect()->route('login');
    })->name('dashboard');
    
    // Lawyer dashboard
    Route::get('/lawyer/dashboard', LawyerDashboard::class)
        ->middleware(['role:lawyer'])
        ->name('lawyer.dashboard');
    
    // Litigant dashboard
    Route::get('/litigant/dashboard', LitigantDashboard::class)
        ->middleware(['role:litigant'])
        ->name('litigant.dashboard');
    
    // Admin dashboard
    Route::get('/admin/dashboard', AdminDashboard::class)
        ->middleware(['role:admin'])
        ->name('admin.dashboard');

    Route::get('/services',  AllServices::class)->name('services');
Route::get('/create-service/{id}', CreateService::class)->name('services.create');
});

Route::get('/register', Register::class)
    ->middleware(['guest'])
    ->name('register');

Route::get('/login', Login::class)
    ->middleware(['guest'])
    ->name('login');
