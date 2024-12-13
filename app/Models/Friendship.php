<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'friend_id', 'status'];

    // Relationship with sender
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with receiver
    public function receiver()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }
}
