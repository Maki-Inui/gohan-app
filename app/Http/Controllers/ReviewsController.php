<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReview;
use App\Models\Review;
use App\Models\Shop;

class ReviewsController extends Controller
{
    public function create($id)
    {
        $shop = Shop::find($id);
        return view('review.post', compact('shop'));
    }

    public function store(StoreReview $request,$shop_id)
    {
        $review = new Review();
        $review->recommend_score = $request->recommend_score;
        $review->food_score = $request->food_score;
        $review->title = $request->title;
        $review->comment = $request->comment;
        $review->shop_id = $shop_id;
        $review->save();

        return redirect()->route('shops.show', ['shop'=>$shop_id])->with('success', 'レビューを投稿しました！');
    }

    public function show($id)
    {
        $review = Review::find($id);
        return view('review.show', compact('review'));
    }

    public function edit($id)
    {
        $review = Review::find($id);
        return view('review.edit', compact('review'));
    }

    public function update(StoreReview $request, $shop_id, $id)
    {
        $update = [
            'title' => $request->title,
            'comment' => $request->comment,
            'recommend_score' => $request->recommend_score,
            'food_score' => $request->food_score,
        ];
        Review::find($id)->update($update);
        return redirect()->route('shops.show', ['shop'=>$shop_id])->with('success', '編集完了');
    }

    public function destroy($shop_id,$id)
    {
        Review::find($id)->delete();
        return redirect()->route('shops.show', ['shop'=>$shop_id])->with('success', 'レビューを削除しました');
    }
}
