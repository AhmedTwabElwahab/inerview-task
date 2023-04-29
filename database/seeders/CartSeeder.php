<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carts')->insert([
            [
                'id'            => 1,
                'user_id'       => DEFAULT_USER_ID,
                'total'         => 30,
            ],
        ]);

        DB::table('cart_items')->insert([
            [
                'cart_id'          => 1,
                'product_id'       => DEFAULT_PRODUCT_ID,
                'quantity'         => 10,
                'total'            => 30,
            ],
        ]);
    }
}
