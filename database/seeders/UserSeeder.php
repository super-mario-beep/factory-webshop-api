<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Seed the users.
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'mario362880@gmail.com',
            'name' => 'Mario',
            'password' => bcrypt('password'),
            'pricelist_name' => 'Mario pricelist'
        ]);
    }
}