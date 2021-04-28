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
        return view('mypage.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $area = $user->area;
        $areas = Area::select('id','area_name')->get();
        return view('mypage.edit', compact('user','area','areas'));
    }

    public function update(Request $request, $id)
    {
        $update = [
            'area_id' => $request->area_id,
            'profile' => $request->profile,
        ];
        User::find($id)->update($update);
        return redirect()->route('mypage.show',['mypage'=>$id])->with('success', '変更完了');
    }
}
