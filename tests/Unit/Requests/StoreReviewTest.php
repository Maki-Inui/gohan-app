<?php

namespace Tests\Unit\Requests;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreReview;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoreReviewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_review()
    {
        Storage::fake('image');
        $file = UploadedFile::fake()->image('review_image.jpg');

        $data_list = [
            'title' => 'タイトル',
            'comment' => 'レビューコメント',
            'image.*' => $file,
        ];

        $request = new StoreReview();
        $rules = $request->rules();
        $validator = Validator::make($data_list, $rules);
        $result = $validator->passes();
        $this->assertTrue($result);
    }
}
