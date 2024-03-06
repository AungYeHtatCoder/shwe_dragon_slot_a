<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','name','order'];
    protected $appends = ['imgUrl']; // Changed from 'image' to 'imgUrl'
    //protected $appends = ['image'];

    public function gameTypes()
    {
        return $this->belongsToMany(GameType::class)->withPivot('image');
    }
    
    public function getImgUrlAttribute()
    {
        if (isset($this->pivot) && isset($this->pivot->image)) {
            return asset('assets/img/game_logo/' . $this->pivot->image);
        }
        return null;
    }

}