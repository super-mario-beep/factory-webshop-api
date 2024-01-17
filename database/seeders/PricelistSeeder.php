<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pricelist;
class PricelistSeeder extends Seeder
{
    /**
     * Seed the pricelists.
     */
    public function run()
    {
        Pricelist::factory(3)->create();
        Pricelist::create(['sku' => 'LAP-100-A', 'price' => 101.00, 'name' => "Mario pricelist"]);
        Pricelist::create(['sku' => 'LAP-100-B', 'price' => 102.00, 'name' => "Mario pricelist"]);
    }
}