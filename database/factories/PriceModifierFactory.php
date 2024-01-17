<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PriceModifier;

class PriceModifierFactory extends Factory
{
    protected $model = PriceModifier::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'modifier_type' => 'offer',
            'value' => $this->faker->randomFloat(2, 5, 20),
            'applies_over' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
