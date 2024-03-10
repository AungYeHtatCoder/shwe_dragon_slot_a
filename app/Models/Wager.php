<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wager extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'seamless_wager_id',
        'status'
    ];

    protected $casts = [
        "status" => TransactionStatus::class
    ];
}