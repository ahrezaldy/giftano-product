<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Repository\ProductCategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $repo;

    public function __construct(ProductCategoryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order = 'order';
        if ($request->has('sort_by') && in_array($request->sort_by, ['id', 'name', 'order'])) {
            $order = $request->sort_by;
        }
        return $this->repo->getCategoryList($order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'order' => 'required|integer|min:1'
        ]);
        return Category::create($validatedData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'order' => 'required|integer|min:1'
        ]);
        $category->update($validatedData);
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return Category::orderBy('order')->get();
    }
}
