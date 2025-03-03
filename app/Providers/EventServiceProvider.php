<?php

namespace App\Providers;


use App\Models\Company;
use App\Models\Log;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Observers\companyObserver;
use App\Observers\LogObserver;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,

        ],
        'App\Events\ProductUpdated' => [
            'App\Listeners\ProductUpdatedListener',
        ],

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Product::observe(ProductObserver::class);
        Log::observe(LogObserver::class);
        User::observe(UserObserver::class);
        Order::observe(OrderObserver::class);
        Company::observe(companyObserver::class);

    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
