<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'gambar_profil',
        'bio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tweets()
{
    return $this->hasMany(Tweets::class);
}



}

