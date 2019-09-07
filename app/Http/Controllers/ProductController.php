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
        return response(['data' => $products]);
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
        $product = Product::create($request->only([
            'name',
        ]));
        return response(['data' => $product]);
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
        return response(['data' => $product]);
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
