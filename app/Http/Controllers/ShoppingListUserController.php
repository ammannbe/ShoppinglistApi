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
        $this->authorize('view-shares', $shoppingList);
        $email = auth()->user()->email;
        return response($shoppingList->users()->exceptUser($email)->pluck('email'));
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
        /** @var User $user */
        $user = User::exceptUser(auth()->user()->email)->findOrFail($request->email, ['email']);
        $email = $user->email;
        $shoppingList->users()->syncWithoutDetaching([$email]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @param  string  $email
     * @return void
     */
    public function destroy(ShoppingList $shoppingList, string $email)
    {
        $this->authorize('delete-shares', $shoppingList);
        $shoppingList->users()->exceptUser($email)->detach($email);
    }
}
