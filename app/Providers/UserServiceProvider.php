<?php

namespace App\Providers;

use App\Services\UserManagementService;
use App\Services\UserRegistrationService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // user registration service binding
        $this->app->bind(UserRegistrationService::class, function ($app) {
            return new UserRegistrationService();
        });

        // user management service binding
        $this->app->bind(UserManagementService::class, function ($app) {
            return new UserManagementService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
