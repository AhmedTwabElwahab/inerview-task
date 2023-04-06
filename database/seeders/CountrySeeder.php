<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            ['id' => 1, 'code' => 'EG', 'name' => 'Egypt', 'shipping_rate' => 5],
            ['id' => 2, 'code' => 'US', 'name' => 'United States', 'shipping_rate' => 3],
            ['id' => 3, 'code' => 'UK', 'name' => 'United Kingdom', 'shipping_rate' => 7],
            ['id' => 4, 'code' => 'FR', 'name' => 'France', 'shipping_rate' => 2],
        ]);

    }
}
