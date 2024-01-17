<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Seed the products.
     */
    public function run()
    {
        $categories = Category::whereNotNull('parent_id')->get();
        $suffixes = ['A', 'B', 'C'];

        foreach ($categories as $category) {
            foreach ($suffixes as $suffix) {
                $productName = ucfirst($category->name) . ' 100, Mark: 100' . $suffix;
                $sku = substr($category->name, 0, 3) . '-100-' . $suffix;

                $product = Product::factory()->create([
                    'name' => $productName,
                    'sku' => strtoupper($sku)
                ]);

                $product->categories()->attach($category);
                $product->categories()->attach($category->parent_id);
            }
        }
    }
}