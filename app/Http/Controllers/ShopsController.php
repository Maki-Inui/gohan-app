<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Http\Requests\StoreShop;
use App\Models\Review;
use App\Models\Visit;
use App\Models\Like;
use App\Models\Nice;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shops = Shop::orderBy('created_at', 'desc')->get();
        return view('shop.index', ['shops' => $shops,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('shop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShop $request)
    {
        //
        Shop::create($request->all());
        return redirect()->route('shops.index')->with('success', '新規登録完了');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::findOrFail($id);
        $reviews = Review::with('nices.user')->where('shop_id', $shop->id)->latest()->get();
        $user_id = Auth::id();
        $visit = Visit::where('shop_id', $shop->id)->where('user_id', $user_id)->first();
        $like = Like::where('shop_id', $shop->id)->where('user_id', $user_id)->first();

        if (Auth::check()) 
        {
        $history = new History();
        $history->shop_id = $shop->id;
        $history->user_id = $user_id;
        $history->save();
        }
 
        return view('shop.show',[
            'shop' => $shop,
            'reviews' => $reviews,
            'visit' => $visit,
            'like' => $like,
            'user_id' => $user_id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $shop = Shop::find($id);
        return view('shop.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreShop $request, $id)
    {
        //
        $update = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        Shop::find($id)->update($update);
        return redirect()->route('shops.show',$id)->with('success', '編集完了');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Shop::find($id)->delete();
        return redirect()->route('shops.index')->with('success', 'お店を削除しました');
    }
}
