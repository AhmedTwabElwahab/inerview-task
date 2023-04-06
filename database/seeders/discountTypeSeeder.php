<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class discountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('discount_types')->insert([
            ['id' => CASH, 'name' => 'cash'],
            ['id' => PERCENT, 'name' => 'percent'],
        ]);
    }
}
