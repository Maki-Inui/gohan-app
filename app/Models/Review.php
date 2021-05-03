<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = [
        'shop_id',
        'title',
        'comment',
        'recommend_score',
        'food_score'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function nices()
    {
        return $this->HasMany(Nice::class);
    }
}
