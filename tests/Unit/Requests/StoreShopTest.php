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

        $dataList = [
            'name' => 'お店の名前',
            'description' => '説明文',
            'image.*' => $file,
        ];

        $request = new StoreShop();
        $rules = $request->rules();
        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();
        $this->assertTrue($result);
    }
}
