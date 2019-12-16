<?php

namespace App\Repository;

use App\Category;

interface ProductCategoryRepositoryInterface
{
    public function getCategoryList($order = 'order');

    public function getProductByCategory(Category $category);
}
