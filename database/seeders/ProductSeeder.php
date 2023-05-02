<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        foreach (range(1, 100) as $index) { 
            DB::table('products')->insert([
                'product_name' => "Product name $index",
                'product_short_name' => "Product short name $index",
                'sku' => substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 20),
                'price' => $faker->numberBetween(50000, 10000000),
                'quantity' => $faker->numberBetween(1, 100),
                'product_description' => $faker->text(),
                'store_id' => $faker->numberBetween(1, 50),
            ]);
        }
    }
}
