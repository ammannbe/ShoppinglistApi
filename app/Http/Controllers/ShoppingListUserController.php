<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ShoppingList;
use App\Http\Requests\ShoppingList\UserStore;

class ShoppingListUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function index(ShoppingList $shoppingList)
    {
        $this->authorize($shoppingList);
        return response(['data' => $shoppingList->users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ShoppingList\UserStore  $request
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function store(UserStore $request, ShoppingList $shoppingList)
    {
        $this->authorize($shoppingList);
        $user = User::whereEmail($request->only(['email']))->firstOrFail();
        $shoppingList->users()->syncWithoutDetaching([$user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingList $shoppingList, User $user)
    {
        $this->authorize($shoppingList);
        if (auth()->user()->id === $user->id) {
            abort(404);
        }
        $shoppingList->users()->detach($user->id);
    }
}
