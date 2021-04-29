<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\Visited;
use Illuminate\Support\Facades\Auth;


class Shop extends Model
{
    use HasFactory;
    protected $table = 'shops';
    protected $fillable = ['name','description'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function visits()
    {
        return $this->hasMany(Visited::class)->withTimestamps();
    }
}
