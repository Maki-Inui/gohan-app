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

class ReviewTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_review_create()
    {
        //レビュー作成に必要なインスタンス作成(お店情報など)
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $this->actingAs($admin_user);
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
            ->for(Area::factory()->state(['area_name' => '新橋']))
            ->for(Category::factory()->state(['category_name' => '中華']))->create();

        $response = $this->get(action('App\Http\Controllers\ReviewsController@create', compact('shop')));
        $response ->assertStatus(200)->assertViewIs('review.post');
    }

    public function test_review_store()
    {
        //レビュー作成に必要なインスタンス作成(お店情報など)
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $this->actingAs($admin_user);
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
            ->for(Area::factory()->state(['area_name' => '新橋']))
            ->for(Category::factory()->state(['category_name' => '中華']))->create();

        //reviewsテーブルに保存するデータ
        $user = User::factory()->create();
        $data = [
            'shop_id' => $shop->id,
            'user_id' => $user->id,
            'title' => '小籠包が美味しい',
            'comment' => '熱々です',
            'recommend_score' => '5',
            'food_score' => '5'
        ]; 

        $response = $this->actingAs($user)->post(action('App\Http\Controllers\ReviewsController@store', $shop->id), $data);

        //reviewsテーブルに投稿したデータが保存されているか
        $this->assertDatabaseHas('reviews', [
            'shop_id' => $shop->id,
            'user_id' => $user->id,
            'title' => '小籠包が美味しい',
            'comment' => '熱々です',
            'recommend_score' => '5',
            'food_score' => '5'
        ]);

        $response = $this->get(action('App\Http\Controllers\ShopsController@show', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.show')->assertSee('小籠包が美味しい');
    }

    public function test_review_show()
    {
        //レビューに必要なデータを作成
        $user = User::factory()->create();
        $this->actingAs($user);
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
            ->for(Area::factory()->state(['area_name' => '新橋']))
            ->for(Category::factory()->state(['category_name' => '中華']))->create();

        //レビュー作成
        $review = Review::factory()->state(['shop_id' => $shop->id, 'title' => '小籠包が美味しい'])->create();

        $response = $this->actingAs($user)->get(action('App\Http\Controllers\ReviewsController@show', ['shop' => $shop->id, 'review' => $review]));

        //ビューの表示チェック
        $response->assertStatus(200)->assertViewIs('review.show')->assertSee('小籠包が美味しい');
    }

    public function test_review_edit()
    {
        //レビュー作成に必要なインスタンス作成
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $this->actingAs($admin_user);
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
            ->for(Area::factory()->state(['area_name' => '新橋']))
            ->for(Category::factory()->state(['category_name' => '中華']))->create();

        //レビュー作成
        $user = User::factory()->create();
        $this->actingAs($user);
        $review = Review::factory()->state(['shop_id' => $shop->id, 'user_id' => $user->id])->create();

        $response = $this->get(action('App\Http\Controllers\ReviewsController@edit', ['shop' => $shop->id, 'review' => $review]));
        $response->assertStatus(200)->assertViewIs('review.edit');
    }

    public function test_review_update()
    {
        //レビューに必要なインスタンス作成
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
        ->for(Area::factory()->state(['area_name' => '新橋',]))
        ->for(Category::factory()->state(['category_name' => '中華']))->create();

        //レビュー作成
        $user = User::factory()->create();
        $this->actingAs($user);
        $review = Review::factory()->state(['shop_id' => $shop->id, 'user_id' => $user->id])->create();

        //reviewsテーブルで更新したいデータ
        $update = ['title' => '酢豚が美味しい', 'comment' => 'コメント', 'recommend_score' =>'5', 'food_score' => '5', ];

        $response = $this->actingAs($user)->put(action('App\Http\Controllers\ReviewsController@update', ['shop' => $shop->id, 'review' => $review->id]), $update);

        //reviewsテーブルに更新後のデータが保存されているか
        $this->assertDatabaseHas('reviews', ['title' => '酢豚が美味しい', 'food_score' => '5']);

        $response = $this->actingAs($user)->get(action('App\Http\Controllers\ShopsController@show', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.show');
        $response->assertSee('編集完了');
    }

    public function test_review_destroy()
    {
        //レビューに必要なインスタンス作成
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
        ->for(Area::factory()->state(['area_name' => '新橋',]))
        ->for(Category::factory()->state(['category_name' => '中華']))->create();

        //レビュー作成
        $user = User::factory()->create();
        $this->actingAs($user);
        $review = Review::factory()->state(['shop_id' => $shop->id, 'user_id' => $user->id, 'title' => '上品な中華'])->create();

        $this->actingAs($user);
        $response = $this->delete(action('App\Http\Controllers\ReviewsController@destroy', ['shop' => $shop->id, 'review' => $review->id]));

        //reviewsテーブルからデータが削除されているか
        $this->assertDatabaseMissing('reviews', [
            'id' => $review->id,
            'title' => '上品な中華'
        ]);

        $response = $this->get(action('App\Http\Controllers\ShopsController@show', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.show')->assertSee('レビューを削除しました');
    }

}
