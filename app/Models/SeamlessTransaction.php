<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeamlessTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "seamless_event_id",
        "user_id",
        "wager_id",
        "seamless_transaction_id",
        "transaction_amount",
        "bet_amount",
        "valid_amount",
        "status",
    ];

    protected $casts = [
        "status" => TransactionStatus::class
    ];
}
