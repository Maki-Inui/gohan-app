<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nice;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class Nice extends Model
{
    protected $table = 'nices';
    protected $fillable = ['review_id', 'user_id'];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
