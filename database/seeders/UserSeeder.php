<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'          => 'ahmed ali',
                'country_id'    => EGYPT_ID,
                'email'         => EMAIL,
                'password'      => Hash::make(PASSWORD),
            ],
        ]);

    }
}
