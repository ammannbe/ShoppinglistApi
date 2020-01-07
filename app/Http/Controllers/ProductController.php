<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Product\Store;
use App\Http\Requests\Product\Update;
use Illuminate\Database\QueryException;

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
        return response(Product::get());
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
        try {
            $product = auth()->user()->products()->create($request->only(['name']));
            return response($product);
        } catch (QueryException $e) {
            abort(409,  __('A resource with this name already exists.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $productName
     * @return \Illuminate\Http\Response
     */
    public function show(string $productName)
    {
        $product = Product::whereName($productName)->firstOrFail();
        $this->authorize($product);
        return response($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\Update  $request
     * @param  string  $productName
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, string $productName)
    {
        $product = auth()->user()->products()->whereName('name', $productName)->firstOrFail();
        $this->authorize($product);
        try {
            $product->update($request->only(['name']));
        } catch (QueryException $e) {
            abort(409,  __('A resource with this name already exists.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $productName
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $productName)
    {
        $product = auth()->user()->products()->whereName('name', $productName)->firstOrFail();
        $this->authorize($product);
        $product->delete();
    }
}
