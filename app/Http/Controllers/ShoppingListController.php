<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ShoppingList;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests\ShoppingList\Store;
use App\Http\Requests\ShoppingList\Update;

class ShoppingListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize(ShoppingList::class);
        return response(['data' => auth()->user()->shoppingLists]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $this->authorize(ShoppingList::class);
        try {
            $shoppingList = ShoppingList::create($request->only([
                'name',
            ]));
            return response($shoppingList, 200);
        } catch (QueryException $e) {
            abort(409, __('A shopping list with this name already exists.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingList $shoppingList)
    {
        $this->authorize($shoppingList);
        return response(['data' => [
            'shopping-list' => $shoppingList,
            'items'         => $shoppingList->items,
        ]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, ShoppingList $shoppingList)
    {
        $this->authorize($shoppingList);
        try {
            $shoppingList->update($request->only([
                'name',
            ]));
        } catch (QueryException $e) {
            abort(409, __('A shopping list with this name already exists.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingList $shoppingList)
    {
        $this->authorize($shoppingList);
        $shoppingList->delete();
    }
}
