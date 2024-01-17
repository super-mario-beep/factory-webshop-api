<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithoutMiddleware;

    public function testProductsReturnsPaginatedProductsForCategory()
    {
        $category = Category::factory()->create();
        $products = Product::factory(25)->create();
        $category->products()->attach($products);

        $response = $this->get(route('category.products', ['category' => $category->id]));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'sku',
                        'price',
                        'categories' => [
                            '*' => [
                                'id',
                                'name',
                            ],
                        ],
                    ],
                ]
            ]);
    }
}
