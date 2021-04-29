<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visited extends Model
{
    use HasFactory;
    protected $table = 'visits';
    protected $fillable = [
        'shop_id',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function shops()
    {
        return $this->belongsToMany(Shop::class)->withTimestamps();
    }

}
