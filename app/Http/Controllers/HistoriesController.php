<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class HistoriesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $histories = History::with('shop')->where('user_id',$user->id)->latest()->get();
        return view('history.index',compact('histories','user'));
    }
}
