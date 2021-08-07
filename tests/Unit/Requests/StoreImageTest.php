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
     * @dataProvider additionProvider
     */
    public function testStoreImage(array $data, bool $expect)
    {
        $data_list = $data;
        $data_list = array_merge($data_list, array('image[]' => ['*' => UploadedFile::fake()->create('dummy.jpg')]));
        $request = new StoreImage();
        $rules = $request->rules();
        $validator = Validator::make($data_list, $rules);
        $result = $validator->passes();
        $this->assertEquals($expect, $result);
    }

    public function additionProvider()
    {
        return [
            'OK' => [
                ['image' => UploadedFile::fake()->create('dummy.png')], 
                true
            ],
            'ファイルが添付されていない' => [
                ['image' => null],
                false
            ],
            '画像の拡張子が違う' => [
                ['image' => UploadedFile::fake()->create('dummy.txt')],
                false
            ],
        ];
    }
}
