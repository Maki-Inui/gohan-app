<?php

namespace Tests\Unit\Requests;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePhoto;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorePhotoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testStorePhoto()
    {
        Storage::fake('image');
        $file = UploadedFile::fake()->image('review_image.jpg');

        $image = ['image' => $file];

        $request = new StorePhoto();
        $rules = $request->rules();
        $validator = Validator::make($image, $rules);
        $result = $validator->passes();
        $this->assertTrue($result);
    }

    public function testErrorPhotoInBlank()
    {
        $image = ['image' => ''];

        $request = new StorePhoto();
        $rules = $request->rules();
        $validator = Validator::make($image, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }

    public function testErrorPhotoEndOfFileName()
    {
        Storage::fake('image');
        $file = UploadedFile::fake()->image('review_image.txt');

        $image = ['image' => $file];

        $request = new StorePhoto();
        $rules = $request->rules();
        $validator = Validator::make($image, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }
}
