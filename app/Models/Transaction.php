<?php

namespace App\Models;

use App\Models\PlaceBet;
use Bavix\Wallet\Models\Transaction as ModelsTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends ModelsTransaction
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "external_transaction_id",
        "operator_id",
        "product_id",
        "provider_id",
        "provider_line_id",
        "wager_id",
        "currency_id",
        "game_type",
        "game_id",
        "game_round_id",
        "valid_bet_amount",
        "bet_amount",
        "transaction_amount",
        "transaction_id",
        "payout_amount",
        "payout_detail",
        "bet_detail",
        "commision_amount",
        "jackpot_amount",
        "settlement_date",
        "jp_bet",
        "status",
        "created_on",
        "modified_on"
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function placeBets()
    {
        return $this->hasMany(PlaceBet::class, 'transaction_id', 'id');
    }

    public function targetUser(){
        return $this->belongsTo(User::class);
    }
}
