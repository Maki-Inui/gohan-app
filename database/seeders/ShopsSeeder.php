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
        $area = DB::table('areas')->first(); 
        $area_id_1 = $area->id;

        $area = DB::table('areas')->skip(2)->first(); 
        $area_id_3 = $area->id;

        $area = DB::table('areas')->skip(3)->first(); 
        $area_id_4 = $area->id;

        DB::table('shops')->insert([
            [
                'name' => 'ハンバーガー店A',
                'description' => 'お店のダミーデータです',
                'category_id' => 1,
                'area_id' => $area_id_1,
                'recommend_score' => 5,
                'food_score' => 5,
                'image' => 'public/image/hamburger.jpg',
            ],
            [
                'name' => 'ラーメン店B',
                'description' => 'お店のダミーデータです',
                'category_id' => 3,
                'area_id' => $area_id_3,
                'recommend_score' => 5,
                'food_score' => 5,
                'image' => 'public/image/4641100_s.jpg',
            ],
            [
                'name' => 'タイ料理店C',
                'description' => 'お店のダミーデータです',
                'category_id' => 2,
                'area_id' => $area_id_4,
                'recommend_score' => 5,
                'food_score' => 5,
                'image' =>'public/image/thai.jpg'
            ]
        ]);
    }
}
