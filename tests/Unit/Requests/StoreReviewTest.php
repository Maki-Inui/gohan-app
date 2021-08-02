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

    public function test_store_review_error_title_in_blank()
    {
        $data_list = [
            'title' => '',
            'comment' => 'レビューコメント'
        ];

        $request = new StoreReview();
        $rules = $request->rules();
        $validator = Validator::make($data_list, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }

    public function test_store_review_error_comment_in_blank()
    {
        $data_list = [
            'title' => 'タイトル',
            'comment' => ''
        ];

        $request = new StoreReview();
        $rules = $request->rules();
        $validator = Validator::make($data_list, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }

    public function test_store_error_title_too_many_charactors()
    {
        $data_list = [
            'title' => 'タイトルを14文字以上入力するとエラーになるテストです',
            'comment' => 'レビューコメント'
        ];

        $request = new StoreReview();
        $rules = $request->rules();
        $validator = Validator::make($data_list, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }

    public function test_store_error_comment_too_many_charactors()
    {
        $data_list = [
            'title' => 'タイトル',
            'comment' => str_repeat('a', 201)
        ];

        $request = new StoreReview();
        $rules = $request->rules();
        $validator = Validator::make($data_list, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }

    public function test_store_error_image_end_of_file_name()
    {
        Storage::fake('image');
        $file = UploadedFile::fake()->image('review_image.txt');

        $image = ['image.*' => $file];

        $request = new StoreReview();
        $rules = $request->rules();
        $validator = Validator::make($image, $rules);
        $result = $validator->passes();
        $this->assertFalse($result);
    }
}
