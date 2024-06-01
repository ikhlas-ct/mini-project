<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'string',
    ];

   

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function tweets(): HasMany
    {
        return $this->hasMany(Tweets::class);
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_user_id');
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_user_id', 'user_id');
    }



    public function likes(): BelongsToMany
{
    return $this->belongsToMany(Tweets::class, 'likes', 'user_id', 'tweet_id')->withTimestamps();
}
public function likeTweet($tweetId)
{
    $this->likes()->attach($tweetId);
}

public function unlikeTweet($tweetId)
{
    $this->likes()->detach($tweetId);
}

public function hasLikedTweet($tweetId)
{
    return $this->likes()->where('tweet_id', $tweetId)->exists();
}

public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
