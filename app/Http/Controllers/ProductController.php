<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Product\Store;
use App\Http\Requests\Product\Update;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize(Product::class);
        $products = Product::global()->orWhere('user_id', auth()->user()->id)->get();
        return response($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\Store  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $this->authorize(Product::class);
        if (Product::whereUserId(auth()->user()->id)->whereName($request->name)->exists()) {
            return response(['errors' => ['name' => ['Name existiert beretis']]], 409);
        }
        $product = Product::create($request->only([
            'name',
        ]));
        return response($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $this->authorize($product);
        return response($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\Update  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Product $product)
    {
        $this->authorize($product);
        $product->update($request->only([
            'name',
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize($product);
        $product->delete();
    }
}
