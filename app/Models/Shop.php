<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;


class Shop extends Model
{
    use HasFactory;
    protected $table = 'shops';
    protected $fillable = ['name','description'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
