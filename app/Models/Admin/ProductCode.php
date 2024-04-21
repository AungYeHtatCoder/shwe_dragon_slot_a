<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
        'product_code',
        'game_type',
        'currency_code',
        'converstion_rate'
    ];
}
