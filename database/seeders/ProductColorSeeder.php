<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductColorSeeder extends Seeder
{
    public function run()
    {
         DB::table('product_colors')->insert([
            [
                // 'product_id' => 1,
                'color' => 'RED',
            ],

            [
                // 'product_id' => 1,
                'color' => 'BLACK',
            ],

            [
                // 'product_id' => 1,
                'color' => 'WHITE',
            ]]);
    }
}
