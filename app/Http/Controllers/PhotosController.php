<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Review;

class PhotosController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  StoreReview $request
     * @param  int  $shop_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $review_id)
    {
        $photo = new Photo();
        $photo->review_id = $review_id;
        $file = $request->file('image');
        $file_name = time() . $file->getClientOriginalName();
        $target_path = public_path('image/review/');
        $file->move($target_path, $file_name);
        $photo->path = $file_name;
        $photo->save();
        $review = $photo->review;

        return view('review.edit', compact('review'))->with('success', '写真を追加しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $shop_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($review_id, $id)
    {
        $photo = Photo::find($id);
        $review = $photo->review;
        $path = public_path('image/review/' . $photo->path);
        \File::delete($path);
        $photo->delete();
        return view('review.edit', compact('review'))->with('success', '写真を削除しました');
    }
}
