<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopPageController extends Controller
{
    //トップページを表示
    public function show(){
        return view('top');
    }
}
