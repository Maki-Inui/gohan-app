<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Image;
use App\Models\User;
use App\Models\Area;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_image_store()
    {
        $admin_user = User::factory()->state(['role_id' => '1'])->create();
        $shop = Shop::factory()->state(['name' => 'おむらいす店'])->for(Area::factory()->state(['area_name' => '原宿',]))
        ->for(Category::factory()->state(['category_name' => '洋食',]))->create();
        Storage::fake('images');
        $file = UploadedFile::fake()->image('shop_image.jpg');
        $file_name = time() . $file->getClientOriginalName();
        $target_path = public_path('image/shop/');
        $file->move($target_path, $file_name);
        $data = ['shop_id' => $shop->id, 'path' => $file_name];
        $response = $this->actingAs($admin_user)->post(action('App\Http\Controllers\ImagesController@store', $shop->id), $data);
        $this->assertDatabaseHas('images', ['path' => $file_name]);
        $response->assertStatus(200)->assertViewIs('shop.edit')->assertSee('画像を追加しました');
    }

}
