<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $tweet_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Tweets $tweet
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Like newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Like newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Like query()
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereTweetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Like whereUserId($value)
 */
	class Like extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $nama
 * @property string|null $gambar_profil
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereGambarProfil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUserId($value)
 */
	class Profile extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $tweet_id
 * @property string $file_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Like> $likes
 * @property-read int|null $likes_count
 * @property-read \App\Models\Tweets $tweet
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|TweetFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TweetFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TweetFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|TweetFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TweetFile whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TweetFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TweetFile whereTweetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TweetFile whereUpdatedAt($value)
 */
	class TweetFile extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TweetFile> $files
 * @property-read int|null $files_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Like> $likes
 * @property-read int|null $likes_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Tweets newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tweets newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tweets query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tweets whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweets whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweets whereUserId($value)
 */
	class Tweets extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\followers> $followers
 * @property-read int|null $followers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $following
 * @property-read int|null $following_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tweets> $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Profile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tweets> $tweets
 * @property-read int|null $tweets_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $follower_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $follower
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|followers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|followers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|followers query()
 * @method static \Illuminate\Database\Eloquent\Builder|followers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|followers whereFollowerUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|followers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|followers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|followers whereUserId($value)
 */
	class followers extends \Eloquent {}
}

