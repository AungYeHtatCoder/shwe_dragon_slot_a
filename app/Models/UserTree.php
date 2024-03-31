<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTree extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'parent_id', 'type', 'parent_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
}
