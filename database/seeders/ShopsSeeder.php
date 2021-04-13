<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Str;  

class ShopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            // 挿入データを設定
            [
                'name' => 'ハンバーガー店A',
                'description' => 'お店のダミーデータです',
                'category' => 'Hamburger',
                'area_id' => 1,
                'recommend_score' => 5,
                'food_score' => 5,
            ],
            [
                'name' => 'ハンバーガー店B',
                'description' => 'お店のダミーデータです',
                'category' => 'Hamburger',
                'area_id' => 2,
                'recommend_score' => 5,
                'food_score' => 5,
            ],
            [
                'name' => 'タイ料理店C',
                'description' => 'お店のダミーデータです',
                'category' => 'Ethnic-food',
                'area_id' => 3,
                'recommend_score' => 5,
                'food_score' => 5,
            ]
        ]);
    }
}
