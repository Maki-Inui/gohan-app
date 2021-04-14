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

Route::resource('shops', 'App\Http\Controllers\ShopsController')->only([
    'index','show' // このメソッドは有効
]);

Route::get('shops', 'App\Http\Controllers\ShopsController@index')->name("shop_list");

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
