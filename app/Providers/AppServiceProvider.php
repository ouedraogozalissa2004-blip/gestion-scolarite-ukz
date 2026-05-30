<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        // Définition de l'autorisation pour l'Enseignant
        Gate::define('access-enseignant', function (User $user) {
            return $user->role === 'enseignant';
        });

        // Définition de l'autorisation pour le Gestionnaire
        Gate::define('access-gestionnaire', function (User $user) {
            return $user->role === 'gestionnaire';
        });
    }
}
