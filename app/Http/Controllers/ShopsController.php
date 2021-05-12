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
    public function index()
    {
        $shops = Shop::orderBy('created_at', 'desc')->get();
        return view('shop.index', compact('shops'));
    }

    public function create()
    {
        return view('shop.create');
    }

    public function store(StoreShop $request)
    {
        Shop::create($request->all());
        return redirect()->route('shops.index')->with('success', '新規登録完了');
    }

    public function show($id)
    {
        $shop = Shop::findOrFail($id);
        $reviews = Review::with('nices.user')->where('shop_id', $shop->id)->latest()->get();
        $user_id = Auth::id();
        $visit = Visit::where('shop_id', $shop->id)->where('user_id', $user_id)->first();
        $like = Like::where('shop_id', $shop->id)->where('user_id', $user_id)->first();

        if (Auth::check()) 
        {
            $old_history = History::where('user_id', $user_id)->where('shop_id', $shop->id);
            if ($old_history->exists())
            {
                $update = ['last_view_at' => date("Y-m-d H:i:s")];
                $old_history->update($update);
            }else 
            {
                $history = new History();
                $history->shop_id = $shop->id;
                $history->user_id = $user_id;
                $history->last_view_at = date("Y-m-d H:i:s");
                $history->save();
            }
        }
 
        return view('shop.show', compact('shop', 'reviews', 'visit', 'like', 'user_id'));
    }

    public function edit($id)
    {
        $shop = Shop::find($id);
        return view('shop.edit', compact('shop'));
    }

    public function update(StoreShop $request, $id)
    {
        $update = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        Shop::find($id)->update($update);
        return redirect()->route('shops.show', $id)->with('success', '編集完了');
    }

    public function destroy($id)
    {
        Shop::find($id)->delete();
        return redirect()->route('shops.index')->with('success', 'お店を削除しました');
    }
}
