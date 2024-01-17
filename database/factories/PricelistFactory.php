<?php

namespace Database\Factories;

use App\Models\Pricelist;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PricelistFactory extends Factory
{
    protected $model = Pricelist::class;

    public function definition()
    {
        $productSku = Product::inRandomOrder()->value('sku');
        $user = User::inRandomOrder()->first();

        return [
            'sku' => $productSku,
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1, 1000)
        ];
    }
}