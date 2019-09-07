<?php

namespace App\Providers;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Item' => 'App\Policies\ItemPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',
        'App\Models\ShoppingList' => 'App\Policies\ShoppingListPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Set expiration date to one week
        Passport::personalAccessTokensExpireIn(Carbon::now()->addHours(3));
    }
}
