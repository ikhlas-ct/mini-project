<?php

use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use App\Models\Profile;
use Illuminate\Support\Facades\Route;



Route::get('/', [LoginController::class, 'index'])->name('login');
Route::POST('/login-user',[LoginController::class,'loginUser'])->name('login_user');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register',[LoginController::class,'register'])->name('register');
Route::POST('/register-user',[LoginController::class,'registerUser'])->name('register_user');

route::get('/dashboard',[LoginController::class,'dashboard'])->name('dashboard');

Route::post('/tweets', [TweetController::class, 'buat_tweet'])->name('buat_tweet');


Route::post('/tweets/{tweet}/like', [TweetController::class, 'likeTweet'])->name('tweets.like');
Route::post('/tweets/{tweet}/unlike', [TweetController::class, 'unlikeTweet'])->name('tweets.unlike');

Route::post('/follow/{id}', [UserController::class, 'follow'])->name('follow');
Route::post('/unfollow/{id}', [UserController::class, 'unfollow'])->name('unfollow');


Route::get('/lihatFollower',[ProfileController::class,'lihat_Follower'])->name('lihat_follower');

Route::get('/profile/{username}', [UserController::class, 'showProfile'])->name('profile');

Route::get('/explore', [ExploreController::class, 'explore_web'])->name('explre.show');

Route::get('/Myprofile/{username}', [UserController::class, 'MyProfile'])->name('my.Profile');

Route::post('/confirm-password', [UserController::class, 'confirmPassword'])->name('confirm-password');


Route::get('/profile/{username}/edit', [UserController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile/update/{username}', [UserController::class, 'Update_Profil'])->name('profile.update');

Route::get('posting/{username}', [UserController::class, 'showPosting'])->name('posting.show');

Route::get('/seepost/{username}/{tweet}', [UserController::class, 'showSeepost'])->name('seepost.show');
Route::post('comments/store', [UserController::class, 'commenstore'])->name('comments.store');
Route::delete('/comments/{comment}', [UserController::class, 'destroycomment'])->name('comments.destroy');
