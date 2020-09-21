<?php

namespace App\Providers;

use App\Models\Item;
use App\Models\User;
use App\Models\ShoppingList;
use App\Observers\ItemObserver;
use App\Observers\UserObserver;
use App\Observers\ShoppingListObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Item::observe(ItemObserver::class);
        ShoppingList::observe(ShoppingListObserver::class);
        User::observe(UserObserver::class);
    }
}
