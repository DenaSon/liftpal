<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {


        //Morph Map For Models :
        Relation::enforceMorphMap([
            'post' => 'App\Models\Post',
            'product' => 'App\Models\Product',
            'slider' =>  'App\Models\Slider',
            'brand' => 'App\Models\Brand',
            'category' => 'App\Models\Category',
            'user' => 'App\Models\User',
            'order' => 'App\Models\Order',
            'invoice' => 'App\Models\Invoice',
            'wallet' => 'App\Models\Wallet',
            'payment' => 'App\Models\Payment',
            'profile' => 'App\Models\Profile',
            'tag' => 'App\Models\Tag',
            'cart' => 'App\Models\Cart',
            'error' => 'App\Models\Error',
            'building' => 'App\Models\Building',
            'elevator' => 'App\Models\Elevator',
            'member' => 'App\Models\Member',
            'request' => 'App\Models\Request',
            'comment' => 'App\Models\Comment',

        ]);



        Schema::defaultStringLength(191);


        //Automatic log LazyLoading  if happened
        Model::handleLazyLoadingViolationUsing(function (Model $model, string $relation) {
            $class = get_class($model);

            info("Attempted to lazy load [{$relation}] on model [{$class}].");
        });

    }
}
