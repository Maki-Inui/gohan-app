<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\TopPageController@show');

Route::resource('shops', 'App\Http\Controllers\ShopsController');

Route::resource('shops.review', 'App\Http\Controllers\ReviewsController');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('mypage', 'mypage.show')->name('mypage');
});

Route::resource('mypage', 'App\Http\Controllers\MypagesController',['only' => ['show', 'edit', 'update']]); 
