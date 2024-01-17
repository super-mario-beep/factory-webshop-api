<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contract;

class ContractSeeder extends Seeder
{
    /**
     * Seed the contracts.
     */
    public function run()
    {
        Contract::factory(3)->create();
    }
}