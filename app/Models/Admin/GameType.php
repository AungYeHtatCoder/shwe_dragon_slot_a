<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameType extends Model
{
    use HasFactory;

    protected $fillable = ['name','code','order','img'];
    protected  $appends = ['image', 'img_url'];

    public function products()
    {
        return $this->belongsToMany(Product::class,'game_type_product')->withPivot('image');
    }

    public function getImageAttribute() //getImageAttribute
    {
        return $this->products->pluck('pivot.image');
    }

    // getImgUrlAttribute
    public function getImgUrlAttribute()
    {
        return asset('assets/img/game_type/' . $this->img);
    }
}
