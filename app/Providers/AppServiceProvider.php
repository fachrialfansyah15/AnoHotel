<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('manage-users', fn (User $user) => $user->role === 'admin');

        Gate::define('manage-rooms', fn (User $user) => in_array($user->role, ['admin', 'manager'], true));

        Gate::define('update-room-status', fn (User $user) => in_array($user->role, ['admin', 'manager', 'housekeeping'], true));

        Gate::define('manage-reservations', fn (User $user) => in_array($user->role, ['admin', 'manager', 'receptionist'], true));

        Gate::define('create-reservation', fn (User $user) => in_array($user->role, ['admin', 'receptionist', 'guest'], true));

        Gate::define('view-own-reservations', fn (User $user) => $user->role === 'guest');

        Gate::define('manage-payments', fn (User $user) => in_array($user->role, ['admin', 'manager', 'receptionist'], true));

        Gate::define('view-own-payments', fn (User $user) => $user->role === 'guest');

        Gate::define('view-reports', fn (User $user) => in_array($user->role, ['admin', 'manager'], true));

        Gate::define('access-ai', fn (User $user) => in_array($user->role, ['admin', 'manager', 'receptionist', 'guest'], true));
    }
}
