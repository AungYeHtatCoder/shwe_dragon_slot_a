<?php

namespace App\Models;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinicalReport extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'date',
        'user_id',
        'turnover',
        'payout',
        'win_lose',
        'commission',
        'parent_commission'
    ];
    protected $casts = [
        'user_type' => UserType::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTurnoverFloatAttribute(): string
    {
        return $this->turnover / 100;
    }

    public function getPayoutFloatAttribute(): string
    {
        return $this->payout / 100;
    }

    public function getWinLoseFloatAttribute(): string
    {
        return $this->win_lose / 100;
    }
}
