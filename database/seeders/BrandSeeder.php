<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           DB::table('brands')->insert([
            [
                'owner_id' => 1,
                'brand_name' => 'ichi',
                'information' => 'ブランド情報を記入',
                'filename' => '',
                'is_selling' => true,
            ],
            [
                'owner_id' => 2,
                'brand_name' => 'cube sugar',
                'information' => 'ブランド情報を記入',
                'filename' => '',
                'is_selling' => true,
            ],
           ]);
    }
}
