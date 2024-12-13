<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    // public function friends()
    // {
    //     return $this->hasMany(Friend::class, 'sender_id');
    // }

    // public function friendOf()
    // {
    //     return $this->hasMany(Friend::class, 'receiver_id');
    // }

    public function sentFriendRequests()
    {
        return $this->hasMany(Friendship::class, 'user_id');
    }

    // Friendships where the user is the receiver
    public function receivedFriendRequests()
    {
        return $this->hasMany(Friendship::class, 'friend_id');
    }

    // Accepted friends
    public function friend()
    {
        return $this->hasMany(Friendship::class, 'user_id')->where('status', 'accepted')
                     ->orWhere('friend_id', $this->id)->where('status', 'accepted');
    }

    // Friends list
    public function friends()
    {
        return $this->hasMany(Friendship::class, 'user_id')
            ->where('status', 'accepted')
            ->orWhere(function ($query) {
                $query->where('friend_id', $this->id)
                      ->where('status', 'accepted');
            });
    }
}
