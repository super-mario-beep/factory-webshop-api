<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'sku' => $this->faker->regexify('[A-Z]{3}-[A-Z0-9]{3}-[A-Z0-9]{3}'),
            'name' => $this->faker->sentence(2, true),
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 0, 1000.00),
            'published' => $this->faker->boolean,
        ];
    }
}