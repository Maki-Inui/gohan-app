<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReview extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:14',
            'comment' => 'required',
            'image.*' => 'image|file|mimes:jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力して下さい。',
            'title.max' => 'タイトルは14文字以内で入力してください',
            'comment.required' => 'レビューを入力して下さい。',
            'image.*.image' => '画像を添付してください',
            'image.*.mimes' => '画像はjpgかpngのみです'
        ];
    }
}
