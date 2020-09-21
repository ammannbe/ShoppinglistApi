<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Item;
use App\Models\ShoppingList;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any items.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return mixed
     */
    public function viewAny(User $user, ShoppingList $shoppingList)
    {
        return $user->can('view', $shoppingList);
    }

    /**
     * Determine whether the user can view the item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Item  $item
     * @return mixed
     */
    public function view(User $user, Item $item)
    {
        $shoppingList = $item->shoppingList;
        return $user->can('view', $shoppingList)
            && $shoppingList->hasUser($user);
    }

    /**
     * Determine whether the user can create items.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return mixed
     */
    public function create(User $user, ShoppingList $shoppingList)
    {
        return $user->can('view', $shoppingList);
    }

    /**
     * Determine whether the user can update the item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Item  $item
     * @return mixed
     */
    public function update(User $user, Item $item)
    {
        $shoppingList = $item->shoppingList;
        return $user->can('view', $shoppingList)
            && $shoppingList->hasUser($user);
    }

    /**
     * Determine whether the user can delete the item.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Item  $item
     * @return mixed
     */
    public function delete(User $user, Item $item)
    {
        $shoppingList = $item->shoppingList;
        return $user->can('view', $shoppingList)
            && $shoppingList->hasUser($user);
    }
}
