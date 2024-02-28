<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlaceBet extends Model
{
    use HasFactory;
     protected $fillable = [
        'member_name',
        'operator_code',
        'product_id',
        'message_id',
        'request_time',
        'sign',
        'transaction_id'
    ];
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
}