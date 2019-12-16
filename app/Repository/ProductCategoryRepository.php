<?php

namespace App\Repository;

use App\Category;
use App\Product;

class ProductCategoryRepository implements ProductCategoryRepositoryInterface
{
    public function getCategoryList($order = 'order')
    {
        return Category::orderBy($order)->get();
    }

    public function getProductByCategory(Category $category)
    {
        return Product::where('category_id', $category->id)->get();
    }
}
