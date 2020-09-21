<?php

namespace App\Http\Controllers;

use App\Models\ShoppingList;
use App\Http\Requests\ShoppingList\Store;
use App\Http\Requests\ShoppingList\Update;

class ShoppingListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\ShoppingList>
     */
    public function index()
    {
        $this->authorize(ShoppingList::class);
        return auth()->user()->shoppingLists;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ShoppingList\Store  $request
     * @return \App\Models\ShoppingList
     */
    public function store(Store $request)
    {
        $this->authorize(ShoppingList::class);
        return ShoppingList::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \App\Models\ShoppingList
     */
    public function show(ShoppingList $shoppingList)
    {
        $this->authorize($shoppingList);
        return $shoppingList;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ShoppingList\Update  $request
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return void
     */
    public function update(Update $request, ShoppingList $shoppingList)
    {
        $this->authorize($shoppingList);
        $shoppingList->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return void
     */
    public function destroy(ShoppingList $shoppingList)
    {
        $this->authorize($shoppingList);
        $shoppingList->delete();
    }
}
