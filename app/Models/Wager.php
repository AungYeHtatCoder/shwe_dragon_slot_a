<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wager extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'seamless_wager_id'
    ];
}