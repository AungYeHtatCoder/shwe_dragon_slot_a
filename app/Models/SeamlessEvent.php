<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeamlessEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "message_id",
        "product_id",
        "request_time",
        "raw_data",
    ];

    protected $casts = [
        "raw_data" => "json",
    ];

    public function transactions(){
        return $this->hasMany(SeamlessTransaction::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
