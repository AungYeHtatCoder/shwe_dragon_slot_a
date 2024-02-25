<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameType extends Model
{
    use HasFactory;

    protected $fillable = ['code','name','order'];
    
    public function products()
    {
        return $this->belongsToMany(Product::class,'game_type_product')->withPivot('image');
    }

    public function getImgUrlAttribute()
    {
        return asset('assets/slot_app/images/icon/' . $this->icon);
    }
}
