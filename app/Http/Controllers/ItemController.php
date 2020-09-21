<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ShoppingList;
use App\Http\Requests\Item\Store;
use App\Http\Requests\Item\Update;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Item>
     */
    public function index(ShoppingList $shoppingList)
    {
        $this->authorize([Item::class, $shoppingList]);
        return $shoppingList->items;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Item\Store  $request
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \App\Models\Item
     */
    public function store(Store $request, ShoppingList $shoppingList)
    {
        $this->authorize([Item::class, $shoppingList]);
        return $shoppingList->items()->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \App\Models\Item
     */
    public function show(Item $item)
    {
        $this->authorize($item);
        return $item;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Item\Update  $request
     * @param  \App\Models\Item  $item
     * @return \App\Models\Item
     */
    public function update(Update $request, Item $item)
    {
        $this->authorize($item);
        $item->update($request->validated());
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function destroy(Item $item)
    {
        $this->authorize($item);
        $item->delete();
    }
}
