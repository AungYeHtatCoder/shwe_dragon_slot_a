<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameType extends Model
{
    use HasFactory;

    protected $fillable = ['name','code', 'image','order'];
    protected  $appends = ['product_image', 'img_url'];

    public function products()
    {
        return $this->belongsToMany(Product::class,'game_type_product')->withPivot('product_image');
    }

    public function getImageAttribute() //getImageAttribute
    {
        return $this->products->pluck('pivot.product_image');
    }

    // getImgUrlAttribute
    public function getImgUrlAttribute()
    {
        return asset('assets/img/game_type/' . $this->image);
    }
     // Define an accessor for the "image" attribute
    // public function getImageAttribute()
    // {
    //     // Return the image attribute from related products or any default logic you prefer
    //     // For example, if you want to return the first product's image
    //     if ($this->products->first()) {
    //         return $this->products->first()->pivot->image;
    //     }

    //     // Return default image or null if no products are associated
    //     return null;
    // }
}