<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoreImageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testStoreImage()
    {
        Storage::fake('image');
        $file = UploadedFile::fake()->image('shop_image.jpg');

        $image = ['image' => $file];

        $request = new StoreImage();
        $rules = $request->rules();
        $validator = Validator::make($image, $rules);
        $result = $validator->passes();
        $this->assertTrue($result);
    }

    public function testErrorImageInBlank()
    {
        $image = ['image' => ''];

        $request = new StoreImage();
        $rules = $request->rules();
        $validator = Validator::make($image, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }

    public function testErrorImageEndOfFileName()
    {
        Storage::fake('image');
        $file = UploadedFile::fake()->image('shop_image.txt');

        $image = ['image' => $file];

        $request = new StoreImage();
        $rules = $request->rules();
        $validator = Validator::make($image, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }
}
