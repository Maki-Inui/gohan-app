<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;

class MypagesController extends Controller
{
    //
    public function show($id)
    {
        $user = User::find($id);
        $area_id = $user->area_id;
        $area = Area::find($area_id);
        return view('mypage.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $area_id = $user->area_id;
        $area = Area::find($area_id);
        return view('mypage.change_area', compact('user','area'));
    }

    public function update(Request $request, $id)
    {
        $update = [
            'area_id' => $request->area_id,
        ];
        User::find($id)->update($update);
        $user = User::find($id);
        return redirect()->route('mypage.show',['mypage'=>$user->id])->with('success', '変更完了');
    }
}
