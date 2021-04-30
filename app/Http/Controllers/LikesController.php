<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$shop_id)
    {
        $like = new Like();
        $like->shop_id = $shop_id;
        $like->user_id = Auth::user()->id;
        $like->save();
        return redirect()->route('shops.show',['shop'=>$shop_id])->with('success', '気になるお店登録完了');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($shop_id,$id)
    {
        Like::find($id)->delete();
        return redirect()->route('shops.show',['shop'=>$shop_id]);
    }
}
