<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PriceModifier;

class PriceModifiersSeeder extends Seeder
{
    public function run()
    {
        PriceModifier::factory()->create([
            'name' => '10% Offer after $100',
            'value' => 10.00,
            'applies_over' => 100.00,
        ]);

        PriceModifier::factory()->create([
            'name' => '15% Offer after $1000',
            'value' => 15.00,
            'applies_over' => 1000.00,
        ]);
    }
}
