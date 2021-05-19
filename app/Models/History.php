<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class History extends Model
{
    protected $table = 'histories';
    protected $fillable = ['shop_id', 'user_id', 'last_view_at'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public static function historyCreateOrUpdate($user_id, $shop_id, $last_view_at)
    {
        if (Auth::check()) 
        {
            return History::updateOrCreate(
                ['user_id' => $user_id, 'shop_id' => $shop_id],
                ['last_view_at' => $last_view_at]
            );
        }
    }
}
