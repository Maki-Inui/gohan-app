<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Http\Requests\StoreShop;
use App\Models\Review;
use App\Models\History;
use App\Models\Area;
use App\Models\Category;
use App\Models\Image;
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
        $areas = Area::all();
        $categories = Category::all();
        return view('shop.create', compact('areas', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  StoreShop $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShop $request)
    {
        $shop = new Shop;
        $shop->name = $request->name;
        $shop->description = $request->description;
        $shop->area_id = $request->area_id;
        $shop->save();

        $files = $request->file('image');
        if ($file = $request->image) 
        {
            foreach($files as $file) 
            {
                $image = new Image();
                $file_name = time() . $file->getClientOriginalName();
                $target_path = public_path('image/shop/');
                $file->move($target_path, $file_name);
                $image->path = $file_name;
                $image->shop_id = $shop->id;
                $image->save();
            }
        }

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
        }
        
        $reviews = Review::where('shop_id', $shop->id)->latest()->get();
        $user = Auth::user();

        if (Auth::check()) 
        {
            $has_shop_visit = $user->hasShopVisit($shop->id);
            $has_shop_like = $user->hasShopLike($shop->id);
            $last_view_at = Carbon::now();
            $history = History::updateOrCreate(
                ['user_id' => $user->id, 'shop_id' => $shop->id],
                ['last_view_at' => $last_view_at]
            );
            return view('shop.show', compact('shop', 'reviews', 'has_shop_visit', 'has_shop_like'));
        }
        return view('shop.show', compact('shop', 'reviews'));
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
        $shop = Shop::find($id);
        $update = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        $shop->update($update);
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
        $shop = Shop::find($id);
        $shop->delete();
        return redirect()->route('shops.index')->with('success', 'お店を削除しました');
    }
}
