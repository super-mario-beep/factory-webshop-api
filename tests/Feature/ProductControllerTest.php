<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndexReturnsPaginatedProducts()
    {
        Product::factory(25)->create();

        $response = $this->get('/api/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'sku',
                        'price',
                        'categories' => [],
                    ],
                ]
            ]);
    }

    public function testShowReturnsProductByIdOrSku()
    {
        $product = Product::factory()->create();

        $response = $this->get("/api/products/{$product->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $product->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'price' => $product->price,
                'categories' => [],
            ]);

        $response = $this->get("/api/products/{$product->sku}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $product->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'price' => $product->price,
                'categories' => [],
            ]);
    }

    public function testShowReturns404ForNonexistentProduct()
    {
        $response = $this->get('/api/products/999');

        $response->assertStatus(404)
            ->assertJson(['error' => 'Product not found.']);
    }

    public function testFilterReturnsFilteredAndSortedProducts()
    {
        $category1 = Category::factory()->create(['name' => 'Category1']);
        $category2 = Category::factory()->create(['name' => 'Category2']);

        $product1 = Product::factory()->create(['name' => 'Product1', 'price' => 101.00]);
        $product1->categories()->attach($category1);

        $product2 = Product::factory()->create(['name' => 'Product2', 'price' => 102.00]);
        $product2->categories()->attach($category2);

        $product3 = Product::factory()->create(['name' => 'Product3', 'price' => 103.00]);
        $product3->categories()->attach($category1);

        $response = $this->get('/api/products/filter?category=Category1&name=Product&sort_by=price&sort_order=desc');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $product3->id,
                        'name' => $product3->name,
                        'sku' => $product3->sku
                    ],
                    [
                        'id' => $product1->id,
                        'name' => $product1->name,
                        'sku' => $product1->sku
                    ],
                ],
            ]);
    }
}
