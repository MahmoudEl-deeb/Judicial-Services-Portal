<?php

use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\ServiceRequestDetails;
use App\Livewire\Auth\Login;
use App\Livewire\Pages\AllServices;
use App\Livewire\Pages\DisplayService;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Register;
use App\Livewire\Lawyer\Dashboard as LawyerDashboard;
use App\Livewire\Litigant\Dashboard as LitigantDashboard;
use App\Livewire\Pages\CreateService;
use App\Livewire\Pages\LandingPage;
use App\Livewire\Pages\Payment;
use App\Livewire\Pages\UserServiceRequests;

Route::middleware(['guest'])->get('/', LandingPage::class)->name('home');



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

    Route::get('/admin/service-requests', \App\Livewire\Admin\ServiceRequests::class)
        ->middleware(['role:admin'])
        ->name('admin.service-requests');

    Route::get('/admin/users', \App\Livewire\Admin\Users::class)
        ->middleware(['role:admin'])
        ->name('admin.users');

    Route::get('/admin/users/{encodeduser}', \App\Livewire\Admin\UserDetails::class)
        ->middleware(['role:admin'])
        ->name('admin.user.details');

    Route::get('/services',  AllServices::class)->name('services');

    Route::get('/create-service/{encodedid}', CreateService::class)->name('services.create');

    Route::get('/service-requests',  UserServiceRequests::class)->middleware('role:lawyer|litigant')->name('services.your');

    Route::get('/admin/service-requests/{encodedId}', ServiceRequestDetails::class)->name('admin.service-request.details');

    Route::get('/service-requests/{encodedid}', \App\Livewire\Pages\ViewServiceRequest::class)->name('service-request.details');

    Route::get('/payment/{encodedserviceRequest}', Payment::class)->name('payment');
});

Route::get('/register', Register::class)
    ->middleware(['guest'])
    ->name('register');

Route::get('/login', Login::class)
    ->middleware(['guest'])
    ->name('login');
