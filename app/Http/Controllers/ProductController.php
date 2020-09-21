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
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Product>
     */
    public function index()
    {
        $this->authorize(Product::class);
        return Product::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\Store  $request
     * @return \App\Models\Product
     */
    public function store(Store $request)
    {
        $this->authorize(Product::class);
        return auth()->user()->products()->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \App\Models\Product
     */
    public function show(Product $product)
    {
        $this->authorize($product);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\Update  $request
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function update(Update $request, Product $product)
    {
        $this->authorize($product);
        $product->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function destroy(Product $product)
    {
        $this->authorize($product);
        $product->delete();
    }
}
