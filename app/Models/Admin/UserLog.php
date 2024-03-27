<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','lastupdate','ip_address','func_access', 'user_agent'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
