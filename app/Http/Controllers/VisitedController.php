<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visited;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class VisitedController extends Controller
{
    public function store(Request $request, $shop_id)
    {
        $visited = new Visited();
        $visited->shop_id = $shop_id;
        $visited->user_id = Auth::user()->id;
        $visited->save();
        return redirect()->route('shops.show',['shop'=>$shop_id])->with('success', '来店済み登録完了');
    }

    public function destroy($shop_id, $id) {
        Visited::find($id)->delete();
        return redirect()->route('shops.show',['shop'=>$shop_id]);
    }
}
