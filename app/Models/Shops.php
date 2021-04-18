<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reviews;


class Shops extends Model
{
    use HasFactory;
    protected $table = 'shops';
    protected $fillable = ['name','description'];

    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }
}
