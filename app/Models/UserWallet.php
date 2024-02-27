<?php

namespace App\Models;

use App\Models\Admin\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user_wallets';

     protected $fillable = [
        'id',
        'user_id',
        'wallet',
        'MemberID',
        'OperatorID',
        'ProductID',
        'ProviderID',
        'ProviderLineID',
        'WagerID',
        'CurrencyID',
        'GameType',
        'GameID',
        'GameRoundID',
        'ValidBetAmount',
        'BetAmount',
        'TransactionAmount',
        'TransactionID',
        'PayoutAmount',
        'PayoutDetail',
        'BetDetail',
        'CommisionAmount',
        'JackpotAmount',
        'SettlementDate',
        'JPBet',
        'Status',
        'CreatedOn',
        'ModifiedOn'
    ];
    protected $dates = ['CreatedOn', 'ModifiedOn'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function placeBets()
    {
        return $this->hasMany(PlaceBet::class, 'TransactionID', 'id');
    }


}