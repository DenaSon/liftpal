<?php

namespace App\Providers;

use App\Models\Address;
use App\Policies\AddressPolicy;
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
        Address::class => AddressPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {


        $this->registerPolicies();

        //Check access for supper admin routes

        Gate::define('admin-access', function ($user) {

            if (auth()->check() && $user->hasVerifiedPhone() && ($user->isRole('admin'))) {
                return true;

            }
            return false;

        });
        // Check for Customers access routes
        Gate::define('customer-access', function ($user) {
            if (auth()->check() && $user->hasVerifiedPhone() && ($user->isRole('customer') || $user->isRole('admin'))) {
                return true;

            }
            return false;

        });

        Gate::define('author', function ($user) {

            if (auth()->check() && $user->hasVerifiedPhone() && ($user->isRole('author'))) {
                return true;

            }
            return false;
        });

        Gate::define('technician', function ($user) {

            if (auth()->check() && $user->hasVerifiedPhone() && ($user->isRole('technician'))) {
                return true;

            }
            return false;
        });


        Gate::define('isTechnician', function ($user) {

            return $user->role === 'technician';
        });


        Gate::define('manager', function ($user) {

            if (auth()->check() && $user->hasVerifiedPhone() && ($user->isRole('manager'))) {
                return true;

            }
            return false;
        });


        Gate::define('company', function ($user) {

            if (auth()->check() && $user->hasVerifiedPhone() && ($user->isRole('company'))) {
                return true;

            }
            return false;
        });


        //Check truest user for cart

        Gate::define('cart-modify', function ($user, $cart) {

            // Check if user is authenticated and cart user ID matches the authenticated user ID
            if (auth()->check() && $user->id === $cart->user_id && $user->hasVerifiedPhone()) {
                return true;
            }

            return false;
        });


    }
}
