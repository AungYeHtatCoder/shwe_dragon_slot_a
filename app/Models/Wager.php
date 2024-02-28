<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wager extends Model
{
    use HasFactory;
    protected $fillable = [
        'wager_id',
        'member_name',
        'product_id',
        'game_type',
        'currency_id',
        'game_id',
        'game_round_id',
        'valid_bet_amount',
        'bet_amount',
        'jp_bet',
        'pay_out_amount',
        'commision_amount',
        'jackpot_amount',
        'settlement_date',
        'status',
        'created_on',
        'modified_on'
    ];
    protected $dates = ['created_at', 'updated_at'];

}