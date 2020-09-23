<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ShoppingList;
use Illuminate\Auth\Events\Registered;
use App\Notifications\ShoppingListShared;
use App\Http\Requests\ShoppingList\UserStore;

class ShoppingListUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Support\Collection
     */
    public function index(ShoppingList $shoppingList)
    {
        $this->authorize('view-shares', $shoppingList);
        return $shoppingList->users()->pluck('email');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ShoppingList\UserStore  $request
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return void
     */
    public function store(UserStore $request, ShoppingList $shoppingList)
    {
        $this->authorize('create-shares', $shoppingList);
        /** @var User|null $user */
        $user = User::find($request->email);

        if (!$user) {
            $user = User::make(['email' => $request->email]);
            event(new Registered($user));
        }

        $shoppingList->users()->syncWithoutDetaching([$user->email]);

        $user->notify(new ShoppingListShared(auth()->user(), $shoppingList));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @param  \App\Models\User  $share
     * @return void
     */
    public function destroy(ShoppingList $shoppingList, User $share)
    {
        $user = $share;
        if (auth()->id() == $user->email) {
            abort(404);
        }

        $this->authorize('delete-shares', $shoppingList);
        $shoppingList->users()->detach($user->email);
    }
}
