<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_name', 'wager_id', 'product_code',
        'game_type_id', 'game_name', 'game_round_id', 'valid_bet_amount',
        'bet_amount', 'payout_amount', 'commission_amount',
        'jack_pot_amount', 'jp_bet', 'status', 'created_on', 'settlement_date', 'modified_on'
    ];
}
