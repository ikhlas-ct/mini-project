<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TweetFile extends Model
{
    use HasFactory;

    protected $fillable = ['tweet_id', 'file_path'];

    public function tweet()
    {
        return $this->belongsTo(Tweets::class, 'tweet_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    



}
