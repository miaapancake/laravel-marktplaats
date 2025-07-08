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
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'desc');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function offeredBids()
    {
        return $this->hasManyThrough(
            Bid::class,
            Post::class,
            'user_id',
            'post_id',
            'id',
            'id'
        );
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

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
}
