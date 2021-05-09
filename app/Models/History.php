<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class History extends Model
{
    use HasFactory;
    protected $table = 'histories';
    protected $fillable = ['shop_id','user_id'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
