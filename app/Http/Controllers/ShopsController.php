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
use Carbon\Carbon;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index()
    {
        $shops = Shop::orderBy('created_at', 'desc')->get();
        return view('shop.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return view
     */
    public function create()
    {
        return view('shop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  StoreShop $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShop $request)
    {
        Shop::create($request->all());
        return redirect()->route('shops.index')->with('success', '新規登録完了');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return view
     */
    public function show($id)
    {
        $shop = Shop::find($id);

        if ($shop === null)
        {
            return redirect()->route('shops.index')->with('failure', '指定されたIDのお店は存在しません');
        }else
        {
            $reviews = Review::with('nices.user')->where('shop_id', $shop->id)->latest()->get();
            $user_id = Auth::id();
            $visit = Visit::where('shop_id', $shop->id)->where('user_id', $user_id)->first();
            $like = Like::where('shop_id', $shop->id)->where('user_id', $user_id)->first();

                if (Auth::check()) 
                {
                    $old_history = History::where('user_id', $user_id)->where('shop_id', $shop->id);
                    $last_view_at = Carbon::now();
                    if ($old_history->exists())
                    {
                        $update = ['last_view_at' => $last_view_at];
                        $old_history->update($update);
                    }else 
                    {
                        $history = new History();
                        $history->shop_id = $shop->id;
                        $history->user_id = $user_id;
                        $history->last_view_at = $last_view_at;
                        $history->save();
                    }
                }
            return view('shop.show', compact('shop', 'reviews', 'visit', 'like'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return view
     */
    public function edit($id)
    {
        $shop = Shop::find($id);
        return view('shop.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  StoreShop $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreShop $request, $id)
    {
        $update = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        Shop::find($id)->update($update);
        return redirect()->route('shops.show', $id)->with('success', '編集完了');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shop::find($id)->delete();
        return redirect()->route('shops.index')->with('success', 'お店を削除しました');
    }
}
