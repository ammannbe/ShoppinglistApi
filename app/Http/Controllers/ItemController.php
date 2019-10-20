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
     * @return \Illuminate\Http\Response
     */
    public function index(ShoppingList $shoppingList)
    {
        $this->authorize('viewAny', [Item::class, $shoppingList]);
        return response($shoppingList->items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Item\Store  $request
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request, ShoppingList $shoppingList)
    {
        $this->authorize([Item::class, $shoppingList]);
        $item = $shoppingList->items()->create($request->only([
            'product_name',
            'unit_name',
            'amount',
            'done',
        ]));
        return response($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        $this->authorize($item);
        return response($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Item\Update  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Item $item)
    {
        $this->authorize($item);
        $item->update($request->only([
            'product_name',
            'unit_name',
            'amount',
            'done',
        ]));
        return response($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $this->authorize($item);
        $item->delete();
    }
}
