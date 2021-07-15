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
use App\Models\Like;
use App\Models\Visit;
use App\Models\history;
use App\Models\Review;
use Carbon\Carbon;

class ShopTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_shop_index()
    {
        $response = $this->get(action('App\Http\Controllers\ShopsController@index'));
        $response->assertStatus(200)->assertViewIs('shop.index');
    }

    public function test_shop_create()
    {
        $areas = Area::factory(5)->create();
        $categories = Category::factory()->state(['category_name' => '中華',])->create();
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $this->actingAs($admin_user);
        $response = $this->get(action('App\Http\Controllers\ShopsController@create',compact('areas','categories')));
        $response ->assertStatus(200)->assertViewIs('shop.create');
    }

    public function test_shop_store()
    {
        $area = Area::factory()->state(['area_name' => '銀座'])->create();
        $category = Category::factory()->state(['category_name' => '中華'])->create();
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $data = [
            'area_id' => $area->id,
            'category_id' => $category->id,
            'name' => '中華レストランA',
            'description' => '小籠包が人気',
            ]; 
        $response = $this->actingAs($admin_user)->post(action('App\Http\Controllers\ShopsController@store', $data));
        $this->assertDatabaseHas('shops', [
            'area_id' => $area->id,
            'category_id' => $category->id,
            'description' => '小籠包が人気'
        ]);
        $response = $this->get(action('App\Http\Controllers\ShopsController@index'));
        $response->assertStatus(200)->assertViewIs('shop.index')->assertSee('中華レストランA');
    }

    public function test_shop_show()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
            ->for(Area::factory()->state(['area_name' => '新橋',]))
            ->for(Category::factory()->state(['category_name' => '中華',]))->create();
        $like = Like::factory()->create(['user_id' => $user->id,'shop_id' => $shop->id]);
        $visit = Visit::factory()->create(['user_id' => $user->id,'shop_id' => $shop->id]);
        Review::factory(2)->state(['shop_id' => $shop->id])->create();
        $reviews = Review::where('shop_id', $shop->id)->latest()->get();
        $last_view_at = Carbon::now(); 
        History::factory()->create(['user_id' => $user->id, 'shop_id' => $shop->id, 'last_view_at' => $last_view_at]);
        $this->assertDatabaseHas('histories', [
            'shop_id' => $shop->id,
            'user_id' => $user->id,
            'last_view_at' => $last_view_at
        ]);
        $user2 = User::find($user->id);
        $this->actingAs($user2);
        $response = $this->actingAs($user2)->get(action('App\Http\Controllers\ShopsController@show', $shop->id, $reviews, $visit, $like));
        $response->assertStatus(200)->assertViewIs('shop.show')->assertSee('餃子が絶品');
    }

    public function test_shop_edit()
    {
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $this->actingAs($admin_user);
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
            ->for(Area::factory()->state(['area_name' => '新橋',]))
            ->for(Category::factory()->state(['category_name' => '中華',]))->create();
        $response = $this->get(action('App\Http\Controllers\ShopsController@edit', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.edit');
    }

    public function test_shop_update()
    {
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $shop = Shop::factory()->state(['name' => '中華B', 'description' => '餃子が絶品'])
        ->for(Area::factory()->state(['area_name' => '新橋',]))
        ->for(Category::factory()->state(['category_name' => '中華',]))->create();
        $update = ['name' => '中華B', 'description' => '水餃子が大人気です'];
        $response = $this->actingAs($admin_user)->put(action('App\Http\Controllers\ShopsController@update', $shop->id), $update);
        $this->assertDatabaseHas('shops', ['description' => '水餃子が大人気です']);
        $admin2 = User::find($admin_user->id);
        $response = $this->actingAs($admin2)->get(action('App\Http\Controllers\ShopsController@show', $shop->id));
        $response->assertStatus(200)->assertViewIs('shop.show');
        $response->assertSee('水餃子が大人気です');
    }

    public function test_shop_destroy()
    {
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $shop = Shop::factory()->state(['name' => 'おむらいす店'])->for(Area::factory()->state(['area_name' => '原宿',]))
        ->for(Category::factory()->state(['category_name' => '洋食',]))->create();
        $this->actingAs($admin_user);
        $response = $this->delete(action('App\Http\Controllers\ShopsController@destroy', ['shop' => $shop->id]));
        $this->assertDatabaseMissing('shops', [
            'id' => $shop->id,
            'name' => 'おむらいす店'
        ]);
        $response = $this->get(action('App\Http\Controllers\ShopsController@index'));
        $response->assertStatus(200)->assertViewIs('shop.index')->assertSee('お店を削除しました');
    }

}

    
