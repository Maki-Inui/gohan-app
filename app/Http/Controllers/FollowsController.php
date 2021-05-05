<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$user_id)
    {
        Follow::firstOrCreate([
            'user_id' => Auth::id(),
            'follow_user_id' => $user_id,
        ]);
        return redirect()->route('users.show',['user'=>$user_id,]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $follow = Follow::where('user_id', Auth::user()->id)->where('follow_user_id',$user_id)->first();
        $follow->delete();
        return redirect()->route('users.show',['user'=>$user_id,]);
    }
}
