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
         DB::table('primary_categories')->insert([
            [
                'name' => 'mens',
                'sort_order' => 1,
            ],

            [
                'name' => 'women',
                'sort_order' => 2,
            ],

            [
                'name' => 'kids',
                'sort_order' => 3,
            ],

            [
                'name' => 'accessory',
                'sort_order' => 4,
            ],
        ]);

        DB::table('secondary_categories')->insert([
            [
                'name' => 'プルオーバー',
                'sort_order' => 2,
                'primary_category_id' => 1
            ],

            [
                'name' => 'シャツ',
                'sort_order' => 3,
                'primary_category_id' => 1
            ],

            [
                'name' => 'パンツ',
                'sort_order' => 4,
                'primary_category_id' => 1
            ],

            [
                'name' => 'ブラウス',
                'sort_order' => 5,
                'primary_category_id' => 2
            ],

            [
                'name' => 'シャツ',
                'sort_order' => 3,
                'primary_category_id' => 2
            ],

            [
                'name' => 'ワンピース',
                'sort_order' => 6,
                'primary_category_id' => 2
            ],


            [
                'name' => 'ジャケット',
                'sort_order' => 7,
                'primary_category_id' => 2
            ],

            [
                'name' => 'コート',
                'sort_order' => 8,
                'primary_category_id' => 2
            ],

            [
                'name' => 'ニット',
                'sort_order' => 9,
                'primary_category_id' => 2
            ],

            [
                'name' => 'パンツ',
                'sort_order' => 4,
                'primary_category_id' => 2
            ],

            [
                'name' => 'スカート',
                'sort_order' => 10,
                'primary_category_id' => 2
            ],


            [
                'name' => 'プルオーバー',
                'sort_order' => 2,
                'primary_category_id' => 3
            ],

            [
                'name' => 'パンツ',
                'sort_order' => 4,
                'primary_category_id' => 3
            ],

            [
                'name' => '帽子',
                'sort_order' => 11,
                'primary_category_id' => 4
            ],

            [
                'name' => 'ソックス',
                'sort_order' => 12,
                'primary_category_id' => 4
            ],


        ]);
    }
}
