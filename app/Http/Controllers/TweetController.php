<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\TweetFile;
use App\Models\Tweets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TweetController extends Controller
{
    public function buat_tweet(Request $request)
{
    $request->validate([
        'content' => 'required|max:280',
        'files.*' => 'file|mimes:jpg,png,jpeg,gif,mp4,mov,avi|max:10240'  // Adjust file types and size as needed
    ]);
    
    $tweet = Tweets::create([
        'user_id' => Auth::id(),
        'content' => $request->content,
    ]);

    if($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $path = $file->store('tweet_files', 'public');

            TweetFile::create([
                'tweet_id' => $tweet->id,
                'file_path' => $path,
            ]);
        }
    }

    return redirect()->back()->with('status', 'Tweet created successfully!');
}



     // Fungsi untuk menyukai sebuah tweet
     public function likeTweet($tweetId)
     {
         $user = Auth::user();
     
         if (!$user->hasLikedTweet($tweetId)) {
             $user->likeTweet($tweetId);
             return redirect()->back()->with('status', 'Tweet liked successfully!');
         } else {
             return redirect()->back()->withErrors(['error' => 'You have already liked this tweet.']);
         }
     }
     public function unlikeTweet($tweetId)
     {
         $user = Auth::user();
     
         if ($user->hasLikedTweet($tweetId)) {
             $user->unlikeTweet($tweetId);
             return redirect()->back()->with('status', 'Tweet unliked successfully!');
         } else {
             return redirect()->back()->withErrors(['error' => 'You have not liked this tweet.']);
         }
     }
  


}
