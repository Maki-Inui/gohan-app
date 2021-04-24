<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReview;
use App\Models\Review;
use App\Models\Shop;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $shop = Shop::find($id);
        return view('review.post', compact('shop'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

        return redirect()->route('shops.show',['shop'=>$shop_id])->with('success', 'レビューを投稿しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::find($id);
        return view('review.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::find($id);
        return view('review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreReview $request,$id)
    {
        $update = [
            'title' => $request->title,
            'comment' => $request->comment,
            'recommend_score' => $request->recommend_score,
            'food_score' => $request->food_score,
        ];
        Review::find($id)->update($update);
        $review = Review::find($id);
        $shop_id = $review->shop_id;
        return redirect()->route('shops.show',['shop'=>$shop_id])->with('success', '編集完了');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Review::find($id)->delete();
        $review = Review::find($id);
        $shop_id = $review->shop_id;
        return redirect()->route('shops.show',['shop'=>$shop_id])->with('success', 'レビューを削除しました');
    }
}
