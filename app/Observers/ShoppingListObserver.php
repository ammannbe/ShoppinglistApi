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
        $shoppingList->user_id = auth()->user()->id;
    }

    /**
     * Handle the shopping list "created" event.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return void
     */
    public function created(ShoppingList $shoppingList)
    {
        $shoppingList->users()->attach(auth()->user()->id);
    }

    /**
     * Handle the shopping list "force deleted" event.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return void
     */
    public function forceDeleted(ShoppingList $shoppingList)
    {
        $shoppingList->users()->attach(auth()->user()->id);
    }
}
