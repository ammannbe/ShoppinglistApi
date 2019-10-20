<?php

namespace App\Observers;

use App\Models\ShoppingList;

class ShoppingListObserver
{
    /**
     * Handle the shopping list "creating" event.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return void
     */
    public function creating(ShoppingList $shoppingList)
    {
        $shoppingList->owner_email = auth()->user()->email;
    }

    /**
     * Handle the shopping list "created" event.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return void
     */
    public function created(ShoppingList $shoppingList)
    {
        $shoppingList->users()->attach(auth()->user()->email);
    }
}
