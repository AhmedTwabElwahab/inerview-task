<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name'  =>  'T-shirt'],
            ['name'  =>  'Blouse'],
            ['name'  =>  'Pants'],
            ['name'  =>  'Sweatpants'],
            ['name'  =>  'Jacket'],
            ['name'  =>  'Shoes'],
        ]);
    }
}
