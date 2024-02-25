<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','name','order'];


    public function gameTypes()
    {
        return $this->belongsToMany(GameType::class)->withPivot('image');
    }

    public function getImgUrlAttribute()
    {
        if (isset($this->pivot) && isset($this->pivot->image)) {
            return asset('assets/slot_app/images/gametypeicon/' . $this->pivot->image);
        }
        return null;
    }

}
