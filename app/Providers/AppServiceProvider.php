<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register services
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services
     */
    public function boot(): void
    {
        Gate::define('admin-only', fn (User $user) => $user->role === 'admin' );
        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        Gate::define('admin-only', function (User $user) {
            return $user->role === 'admin';
        });

        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        Gate::define('manage-users', function (User $user) {
            return $user->role === 'admin';
        });

        /*
        |--------------------------------------------------------------------------
        | ROOMS
        |--------------------------------------------------------------------------
        */

        Gate::define('manage-rooms', function (User $user) {
            return in_array($user->role, [
                'admin',
                'manager'
            ]);
        });

        Gate::define('update-room-status', function (User $user) {
            return in_array($user->role, [
                'admin',
                'manager'
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | RESERVATIONS
        |--------------------------------------------------------------------------
        */

        Gate::define('manage-reservations', function (User $user) {
            return in_array($user->role, [
                'admin',
                'manager',
                'receptionist'
            ]);
        });

        Gate::define('create-reservation', function (User $user) {
            return in_array($user->role, [
                'admin',
                'receptionist',
                'guest'
            ]);
        });

        Gate::define('view-own-reservations', function (User $user) {
            return $user->role === 'guest';
        });

        /*
        |--------------------------------------------------------------------------
        | PAYMENTS
        |--------------------------------------------------------------------------
        */

        Gate::define('manage-payments', function (User $user) {
            return in_array($user->role, [
                'admin',
                'manager',
                'receptionist'
            ]);
        });

        Gate::define('view-own-payments', function (User $user) {
            return $user->role === 'guest';
        });

        /*
        |--------------------------------------------------------------------------
        | REPORTS
        |--------------------------------------------------------------------------
        */

        Gate::define('view-reports', function (User $user) {
            return in_array($user->role, [
                'admin',
                'manager'
            ]);
        });
        

        /*
        |--------------------------------------------------------------------------
        | AI
        |--------------------------------------------------------------------------
        */

        Gate::define('access-ai', function (User $user) {
            return in_array($user->role, [
                'admin',
                'manager',
                'receptionist',
                'guest'
            ]);
        });
    }
}