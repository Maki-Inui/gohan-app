<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shops;


class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = [
        'shop_id',
        'title',
        'comment',
    ];

    public function shop()
    {
        return $this->belongsTo(Shops::class);
    }
}
