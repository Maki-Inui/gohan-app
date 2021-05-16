<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follow;

class UsersController extends Controller
{
    public function index()
    {
        $all_users = User::all();
        return view('users.index',compact('all_users'));
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user === null)
        {
            return redirect()->route('users.index')->with('failure', '指定されたIDのアカウントは存在しません');
        }

        $login_user = Auth::user();
        $follow = Follow::where('user_id', $login_user->id)->where('follow_user_id',$user->id)->first();
        return view('users.show', compact('user','follow'));
    }
}
