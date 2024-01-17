<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Pricelist;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'email' => $this->faker->email,
            'name' => $this->faker->name,
            'password' => bcrypt('password')
        ];
    }
}