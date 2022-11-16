<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('products')->insert([
            [
                'brand_id' => 1,
                'secondary_category_id' => 2,
                'image1' => 1,
            ],

            [
                'brand_id' => 1,
                'secondary_category_id' => 3,
                'image1' => 2,
            ],

            [
                'brand_id' => 1,
                'secondary_category_id' => 4,
                'image1' => 4,
            ],

            [
                'brand_id' => 1,
                'secondary_category_id' => 5,
                'image1' => 5,
            ],

            [
                'brand_id' => 1,
                'secondary_category_id' => 6,
                'image1' => 6,
            ],
         ]);
    }
}
