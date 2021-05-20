<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/* use Laravel\Fortify\TwoFactorAuthenticatable; */
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasProfilePhoto;
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'profile', 'area_id'];

    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'];

    protected $casts = ['email_verified_at' => 'datetime'];

    protected $appends = ['profile_photo_url'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    //フォロー中のユーザー
    public function follows()
    {
      return $this->belongsToMany(User::class, 'follows', 'user_id', 'follow_user_id');
    }

    //フォロされているユーザー
    public function followUsers()
    {
      return $this->belongsToMany(User::class, 'follows', 'follow_user_id', 'user_id');
    }

    public function hasShopVisit($shop_id)
    {
      return $this->hasMany(Visit::class)->where('shop_id', $shop_id)->exists();
    }

    public function hasShopLike($shop_id)
    {
      return $this->hasMany(Like::class)->where('shop_id', $shop_id)->exists();
    }

    public function hasReviewNice($review_id)
    {
      return $this->hasMany(Nice::class)->where('review_id', $review_id)->exists();
    }
}
