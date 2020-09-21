<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ShoppingList;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShoppingListPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any shopping lists.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the shopping list.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return mixed
     */
    public function view(User $user, ShoppingList $shoppingList)
    {
        return (bool) $user->shoppingLists()->find($shoppingList->id);
    }

    /**
     * Determine whether the user can view the shopping list shares.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewShares(User $user, ShoppingList $shoppingList)
    {
        return $user->isOwnerOf($shoppingList->owner_email);
    }

    /**
     * Determine whether the user can create shopping lists.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create shopping list shares.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function createShares(User $user, ShoppingList $shoppingList)
    {
        return $user->isOwnerOf($shoppingList->owner_email);
    }

    /**
     * Determine whether the user can update the shopping list.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return mixed
     */
    public function update(User $user, ShoppingList $shoppingList)
    {
        return $user->shoppingLists()->whereId($shoppingList->id)->exists();
    }

    /**
     * Determine whether the user can delete the shopping list.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return mixed
     */
    public function delete(User $user, ShoppingList $shoppingList)
    {
        return $user->isOwnerOf($shoppingList->owner_email);
    }

    /**
     * Determine whether the user can delete the shopping list shares.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return mixed
     */
    public function deleteShares(User $user, ShoppingList $shoppingList)
    {
        return $user->isOwnerOf($shoppingList->owner_email);
    }
}
