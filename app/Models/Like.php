<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = 'likes';
    protected $fillable = [
        'shop_id',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class)->withTimestamps();
    }

    public function shops()
    {
        return $this->belongsTo(Shop::class)->withTimestamps();
    }
}
