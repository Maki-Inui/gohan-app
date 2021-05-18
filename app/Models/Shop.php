<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;


class Shop extends Model
{
    protected $table = 'shops';
    protected $fillable = ['name', 'description', 'category_id', 'area_id', 'image'];
}
