<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    protected $model = Contract::class;

    public function definition()
    {
        $productSku = Product::inRandomOrder()->value('sku');
        $user = User::inRandomOrder()->first();

        return [
            'user_id' => $user->getKey(),
            'sku' => $productSku,
            'price' => $this->faker->randomFloat(2, 0, 1000.00),
        ];
    }
}