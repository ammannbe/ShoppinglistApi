<?php

namespace App\Observers;

use App\Models\Item;

class ItemObserver
{
    /**
     * Handle the item "creating" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function creating(Item $item)
    {
        $item->user_id = auth()->user()->id;
    }
}
