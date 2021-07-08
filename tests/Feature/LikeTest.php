<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Like;
use App\Models\User;
use App\Models\Shop;


class LikeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_like_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(action('App\Http\Controllers\LikesController@index', $user->id));
        $response->assertStatus(200)->assertViewIs('like.index');
    }

    public function test_like_store()
    {
        $shop = Shop::all()->first();
        $user = User::factory()->create();
        $this->actingAs($user);
        Like::firstOrCreate([
            'user_id' => $user->id,
            'shop_id' => $shop->id
        ]);
        $response = $this->get(action('App\Http\Controllers\ShopsController@show', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.show')->assertSee('お気に入りのお店');
    }

    public function test_like_destroy()
    {
        $shop = Shop::all()->first();
        $user = User::factory()->create();
        $this->actingAs($user);
        Like::firstOrCreate([
            'user_id' => $user->id,
            'shop_id' => $shop->id
        ]);
        $user->shop_like($shop->id)->delete();
        $response = $this->get(action('App\Http\Controllers\ShopsController@show', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.show')->assertSee('気になるお店に登録');
    }
}
