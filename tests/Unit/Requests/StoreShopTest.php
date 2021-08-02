<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreShop;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoreShopTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_store_shop()
    {
        Storage::fake('image');
        $file = UploadedFile::fake()->image('shop_image.jpg');

        $data_list = [
            'name' => 'お店の名前',
            'description' => '説明文',
            'image.*' => $file,
        ];

        $request = new StoreShop();
        $rules = $request->rules();
        $validator = Validator::make($data_list, $rules);
        $result = $validator->passes();
        $this->assertTrue($result);
    }

    public function test_store_error_shop_name_in_blank()
    {
        $data_list = [
            'name' => '',
            'description' => '説明文'
        ];

        $request = new StoreShop();
        $rules = $request->rules();
        $validator = Validator::make($data_list, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }

    public function test_store_error_shop_description_in_blank()
    {
        $data_list = [
            'name' => 'お店の名前',
            'description' => ''
        ];

        $request = new StoreShop();
        $rules = $request->rules();
        $validator = Validator::make($data_list, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }

    public function test_store_error_shop_name_too_many_charactors()
    {
        $data_list = [
            'name' => 'お店の名前を10文字以上入力するとエラーになるテスト',
            'description' => '説明文',
        ];

        $request = new StoreShop();
        $rules = $request->rules();
        $validator = Validator::make($data_list, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }

    public function test_store_error_shop_description_too_many_charactors()
    {
        $data_list = [
            'name' => 'お店の名前',
            'description' => str_repeat('a', 101),
        ];

        $request = new StoreShop();
        $rules = $request->rules();
        $validator = Validator::make($data_list, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }

    public function test_store_error_image_end_of_file_name()
    {
        Storage::fake('image');
        $file = UploadedFile::fake()->image('shop_image.txt');

        $image = ['image.*' => $file];

        $request = new StoreShop();
        $rules = $request->rules();
        $validator = Validator::make($image, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }
}
