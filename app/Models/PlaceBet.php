<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceBet extends Model
{
    use HasFactory;
     protected $fillable = [
        'MemberName',
        'OperatorCode',
        'ProductID',
        'MessageID',
        'RequestTime',
        'Sign',
        'user_wallet_id'
    ];
    public function userWallet()
    {
        return $this->belongsTo(UserWallet::class, 'TransactionID', 'id');
    }
}