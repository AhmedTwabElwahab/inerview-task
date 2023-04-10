<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('offers')->insert([
            [
                'id'                       => 1,
                'name'                     => 'Shoes 10%',
                'desc'                     => 'buy shoes Get 10% discount',
                'shopping_rate_offer'      => false,
                'end_date'                 => date('Y-m-d',2024/8/12),
                'created_at'               => Carbon::now()->format('Y-m-d H:i:s')

            ],
            [
                'id'                       => 2,
                'name'                     => 't-shirt',
                'desc'                     => 'Buy any two tops (t-shirt) and get any jacket half its price',
                'shopping_rate_offer'      => false,
                'end_date'                 => date('Y-m-d',2024/8/12),
                'created_at'               => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id'                       => 3,
                'name'                     => 'blouse',
                'desc'                     => 'Buy any two tops (blouse) and get any jacket half its price',
                'shopping_rate_offer'      => false,
                'end_date'                 => date('Y-m-d',2024/8/12),
                'created_at'               => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id'                       => 4,
                'name'                     => 'shipping',
                'desc'                     => 'Buy any two items or more and get a maximum of $10 off shipping fees.',
                'shopping_rate_offer'      => true,
                'end_date'                 => date('Y-m-d',2024/8/12),
                'created_at'               => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
        DB::table('discounts')->insert([
            [
                'offer_id'          => 1,
                'product_id'        => SHOES,
                'min_order_value'   => 1,
                'discount_value'    => 10,
                'discount_type_id'  => PERCENT,
            ],
            [
                'offer_id'          => 2,
                'product_id'        => T_SHIRT,
                'min_order_value'   => 2,
                'discount_value'    => 0,
                'discount_type_id'  => PERCENT,
            ],
            [
                'offer_id'          => 2,
                'product_id'        => JACKET,
                'min_order_value'   => 1,
                'discount_value'    => 50,
                'discount_type_id'  => PERCENT,
            ],
            [
                'offer_id'          => 3,
                'product_id'        => BLOUSE,
                'min_order_value'   => 2,
                'discount_value'    => 0,
                'discount_type_id'  => PERCENT,
            ],
            [
                'offer_id'          => 3,
                'product_id'        => JACKET,
                'min_order_value'   => 1,
                'discount_value'    => 50,
                'discount_type_id'  => PERCENT,
            ],
            [
                'offer_id'          => 4,
                'product_id'        => NUll, //if product_id NULL this is mean discount for all products
                'min_order_value'   => 2,
                'discount_value'    => 10,
                'discount_type_id'  => CASH,
            ],
        ]);

    }
}
