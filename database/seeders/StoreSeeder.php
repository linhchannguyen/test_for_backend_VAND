<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        foreach (range(1, 50) as $index) { 
            DB::table('stores')->insert([
                'store_name' => $faker->name,
                'store_address' => $faker->address,
                'user_id' => $faker->numberBetween(1, 3)
            ]);
        }
    }
}
