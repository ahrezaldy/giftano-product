<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        return Product::where('category_id', $category->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category, Request $request)
    {
        $request->merge(['category_id' => $category->id]);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|integer|min:1'
        ]);
        return Product::create($validatedData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, Product $product)
    {
        if ($product->category_id !== $category->id) {
            abort(404);
        }
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, Request $request, Product $product)
    {
        if ($product->category_id !== $category->id) {
            abort(404);
        }
        $request->merge(['category_id' => $category->id]);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|integer|min:1'
        ]);
        $product->update($validatedData);
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Product $product)
    {
        if ($product->category_id !== $category->id) {
            abort(404);
        }
        $product->delete();
        return Product::where('category_id', $category->id)->get();
    }
}
