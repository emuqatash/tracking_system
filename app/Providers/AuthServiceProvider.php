<?php

namespace App\Providers;

use App\Models\Miscellaneous;
use App\Models\MiscellaneousCategory;
use App\Models\User;
use App\Policies\MiscellaneousCategoryPolicy;
use App\Policies\MiscellaneousPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Miscellaneous::class => MiscellaneousPolicy::class,
        MiscellaneousCategory::class => MiscellaneousCategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Admin') ? true : null;
        });
    }
}
