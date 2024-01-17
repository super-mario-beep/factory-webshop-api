<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function products(Category $category)
    {
        $products = $category->products()->paginate(20);

        return response()->json($products);
    }
}
