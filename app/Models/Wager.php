<?php

namespace App\Models;

use App\Enums\WagerStatus;
use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wager extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seamless_wager_id',
        'product_id',
        'game_type_id',
        'bet_amount',
        'payout_amount',
        'status'
    ];

    protected $casts = [
        "status" => WagerStatus::class
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function transactions()
    {
        return $this->hasMany(SeamlessTransaction::class);
    }

    public function latestTransaction()
    {
        return $this->hasOne(SeamlessTransaction::class)->latestOfMany();
    }
}
