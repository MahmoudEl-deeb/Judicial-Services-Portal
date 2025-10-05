<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.dash', function ($view) {
            /** @var \App\Models\User|null $user */
            $user = Auth::user();
            $links = [];

            if ($user) {
                if ($user->hasRole('admin')) {
                    $links = array_merge($links, [
                        ['url' => route('admin.dashboard'), 'label' => 'لوحة التحكم', 'icon' => 'fas fa-tachometer-alt', 'active' => 'admin/dashboard'],
                        ['url' => route('admin.service-requests'), 'label' => 'طلبات الخدمة', 'icon' => 'fas fa-cogs', 'active' => 'admin/service-requests'],
                        ['url' => route('admin.users'), 'label' => 'المستخدمين', 'icon' => 'fas fa-users', 'active' => 'admin/users'],
                        // Add more admin links here
                    ]);
                } elseif ($user->hasRole('lawyer')) {
                    $links = array_merge($links, [
                        ['url' => route('lawyer.dashboard'), 'label' => 'لوحة التحكم', 'icon' => 'fas fa-tachometer-alt', 'active' => 'lawyer/dashboard'],
                        ['url' => route('services'), 'label' => 'كل الخدمات', 'icon' => 'fas fa-cogs', 'active' => 'services'],
                        ['url' => route('services.your'), 'label' => 'خدماتك', 'icon' => 'fas fa-history', 'active' => 'service-requests'],
                        // Add more lawyer links here
                    ]);
                } elseif ($user->hasRole('litigant')) {
                    $links = array_merge($links, [
                        ['url' => route('litigant.dashboard'), 'label' => 'لوحة التحكم', 'icon' => 'fas fa-tachometer-alt', 'active' => 'litigant/dashboard'],
                        ['url' => route('services'), 'label' => 'كل الخدمات', 'icon' => 'fas fa-cogs', 'active' => 'services'],
                        ['url' => route('services.your'), 'label' => 'خدماتك', 'icon' => 'fas fa-history', 'active' => 'service-requests'],
                        // Add more litigant links here
                    ]);
                }
            }

            $view->with('links', $links);
        });
    }
}
