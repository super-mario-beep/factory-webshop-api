<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::with('categories')->paginate(20);

        return response()->json($products);
    }

    /**
     * Display the specified resource.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($identifier)
    {
        $product = Product::with('categories')
            ->where('id', $identifier)
            ->orWhere('sku', $identifier)
            ->first();

        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }

    /**
     * Display the specified resources with filter and sort.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request)
    {
        $category = $request->input('category');
        $query = Product::query();

        if ($category) {
            $query->whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }

        $name = $request->input('name');
        if ($name) {
            $query->where('name', 'like', "%$name%");
        }

        $sortBy = $request->input('sort_by', 'name');
        $sortOrder = $request->input('sort_order', 'asc');

        if ($sortBy === 'price') {
            $query->orderBy('price', $sortOrder);
        } elseif ($sortBy === 'name') {
            $query->orderBy('name', $sortOrder);
        }

        $products = $query->paginate(20);

        return response()->json($products);
    }
}
