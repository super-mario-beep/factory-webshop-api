<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Pricelist;
use App\Models\Contract;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            PricelistSeeder::class,
            UserSeeder::class,
            ContractSeeder::class,
            PriceModifiersSeeder::class,
        ]);

        Contract::create(['sku' => 'LAP-100-C', 'price' => 100.00, 'user_id' => 1]);
    }
}
