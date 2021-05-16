<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReview;
use App\Models\Review;
use App\Models\Shop;

class ReviewsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return view
     */
    public function create($id)
    {
        $shop = Shop::find($id);
        return view('review.post', compact('shop'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  StoreReview $request
     * @param  int  $shop_id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReview $request,$shop_id)
    {
        $review = new Review();
        $review->recommend_score = $request->recommend_score;
        $review->food_score = $request->food_score;
        $review->title = $request->title;
        $review->comment = $request->comment;
        $review->shop_id = $shop_id;
        $review->save();

        return redirect()->route('shops.show', ['shop' => $shop_id])->with('success', 'レビューを投稿しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return view
     */
    public function show($id, $shop_id)
    {
        $review = Review::where('shop_id', $shop_id)->where('id', $id)->first();

        if ($review === null)
        {
            return redirect()->route('shops.index')->with('failure', '指定されたIDのショップレビューは存在しません');
        }

        return view('review.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return view
     */
    public function edit($id)
    {
        $review = Review::find($id);
        return view('review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  StoreReview $request
     * @param  int  $shop_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreReview $request, $shop_id, $id)
    {
        $update = [
            'title' => $request->title,
            'comment' => $request->comment,
            'recommend_score' => $request->recommend_score,
            'food_score' => $request->food_score,
        ];
        Review::find($id)->update($update);
        return redirect()->route('shops.show', ['shop' => $shop_id])->with('success', '編集完了');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $shop_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($shop_id, $id)
    {
        Review::find($id)->delete();
        return redirect()->route('shops.show', ['shop' => $shop_id])->with('success', 'レビューを削除しました');
    }
}
