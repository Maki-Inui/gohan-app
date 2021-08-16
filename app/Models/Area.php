<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function hasShopCount()
    {
        return $this->hasMany(Shop::class)->count();
    }
}
