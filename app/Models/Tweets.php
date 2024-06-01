<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweets extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class, 'tweet_id'); // Menggunakan 'tweet_id' sebagai foreign key
    }
    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

  
   public function files()
    {
        return $this->hasMany(TweetFile::class, 'tweet_id');
    }

    public function profile()
{
    return $this->belongsTo(Profile::class);
}
public function comments()
{
    return $this->hasMany(Comment::class);
}


}

