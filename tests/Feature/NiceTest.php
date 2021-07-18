<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Shop;
use App\Models\User;
use App\Models\Area;
use App\Models\Category;
use App\Models\Review;
use App\Models\Nice;


class NiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_nice_store()
    {
        //ナイス作成に必要なインスタンスを作成
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
            ->for(Area::factory()->state(['area_name' => '新橋']))
            ->for(Category::factory()->state(['category_name' => '中華']))->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $review = Review::factory()->state(['shop_id' => $shop->id, 'user_id' => $user->id])->create();

        $response = $this->actingAs($user)->post(action('App\Http\Controllers\NicesController@store', ['shop' => $shop->id, 'review' => $review->id]));

        //nicesテーブルに投稿したデータが保存されているか
        $this->assertDatabaseHas('nices', [
            'user_id' => $user->id,
            'review_id' => $review->id,
        ]);

        $response = $this->actingAs($user)->get(action('App\Http\Controllers\ShopsController@show', $shop->id));
        $response->assertViewIs('shop.show');
    }

    public function test_nice_destroy()
    {
        //ナイス作成に必要なインスタンスを作成
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
            ->for(Area::factory()->state(['area_name' => '新橋']))
            ->for(Category::factory()->state(['category_name' => '中華']))->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $review = Review::factory()->state(['shop_id' => $shop->id, 'user_id' => $user->id])->create();

        //ナイス作成
        $this->actingAs($user);
        $nice = Nice::factory()->state(['user_id' => $user->id, 'review_id' => $review->id])->create();

        $response = $this->delete(action('App\Http\Controllers\NicesController@destroy', ['shop' => $shop->id, 'review' => $review->id, 'nice' => $nice->id]));

        //nicesテーブルからデータが削除されているか
        $this->assertDatabaseMissing('nices', [
            'review_id' => $review->id,
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)->get(action('App\Http\Controllers\ShopsController@show', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.show');
    }
}
