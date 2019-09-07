<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product;
use App\Models\ShoppingList;
use App\Http\Requests\Item\Store;
use App\Http\Requests\Item\Update;

class ItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Item\Store  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $this->authorize('view', ShoppingList::find($request->shopping_list_id));
        $this->authorize('view', Product::find($request->product_id));
        $this->authorize(Item::class);
        $item = Item::create($request->only([
            'shopping_list_id',
            'product_id',
            'unit_id',
            'amount',
            'done',
        ]));
        return response(['data' => $item]);
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
        return response(['data' => $item]);
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
        if ($request->shopping_list_id) {
            $this->authorize('view', ShoppingList::find($request->shopping_list_id));
        }
        if ($request->product_id) {
            $this->authorize('view', Product::find($request->product_id));
        }
        $this->authorize($item);
        $item->update($request->only([
            'shopping_list_id',
            'product_id',
            'unit_id',
            'amount',
            'done',
        ]));
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
