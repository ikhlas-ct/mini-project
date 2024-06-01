<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;
use App\Models\Tweets;
use Illuminate\Support\Facades\Log;




class UserController extends Controller
{



    public function MyProfile($username)
    {
        $user = User::where('username', $username)
                    ->with(['tweets' => function ($query) {
                        $query->orderBy('created_at', 'desc'); // Urutkan tweets berdasarkan created_at secara descending
                    }])
                    ->firstOrFail();
        
        return view('myprofil', compact('user'));
    }

    public function confirmPassword(Request $request)
    {
        $user = Auth::user();
    
        if (Hash::check($request->password, $user->password)) {
            return redirect()->route('profile.edit', ['username' => $user->username]);
        } else {
            return redirect()->back()->withErrors(['password' => 'Password is incorrect']);
        }
    }
    
    public function editProfile($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('profileedit', compact('user'));
    }

    // Method to handle the profile update
    public function Update_Profil(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $profile = $user->profile;
        $profile->nama = $validatedData['name'];
        $profile->bio = $validatedData['bio'];

        if ($request->hasFile('profile_image')) {
            Log::info('Profile image found in request.');

            if ($request->file('profile_image')->isValid()) {
                Log::info('Profile image upload:', [
                    'original_name' => $request->file('profile_image')->getClientOriginalName(),
                    'mime_type' => $request->file('profile_image')->getMimeType(),
                    'size' => $request->file('profile_image')->getSize(),
                ]);

                if ($profile->gambar_profil) {
                    Storage::disk('public')->delete($profile->gambar_profil);
                    Log::info('Old profile image deleted.');
                }

                $path = $request->file('profile_image')->store('profile_images', 'public');
                $profile->gambar_profil = $path;
                Log::info('New profile image stored at: ' . $path);
            } else {
                Log::error('Invalid profile image upload attempt.');
            }
        } else {
            Log::error('Profile image not found in request.');
        }

        $profile->save();
        Log::info('Profile updated successfully.');

        return redirect()->route('profile.edit', ['username' => $user->username])->with('success', 'Profile updated successfully!');
    }
    



 
    public function follow($id)
    {
        $user = Auth::user();
        $userToFollow = User::findOrFail($id);

        if (!$user->following()->where('user_id', $id)->exists()) {
            $user->following()->attach($userToFollow);
            return redirect()->back()->with('status', 'User followed successfully!');
        } else {
            return redirect()->back()->withErrors(['error' => 'You are already following this user.']);
        }
    }

    public function unfollow($id)
    {
        $user = Auth::user();
        $userToUnfollow = User::findOrFail($id);

        if ($user->following()->where('user_id', $id)->exists()) {
            $user->following()->detach($userToUnfollow);
            return redirect()->back()->with('status', 'User unfollowed successfully!');
        } else {
            return redirect()->back()->withErrors(['error' => 'You are not following this user.']);
        }
    }


    public function showPosting($username){
        $user = User::where('username', $username)->firstOrFail();
        $tweets = $user->tweets()->orderBy('created_at', 'desc')->get();
        return view('posting', compact('user', 'tweets'));
        
    }
    public function showSeepost($username, $tweetId){
        // Temukan pengguna berdasarkan nama pengguna (username)
    $user = User::where('username', $username)->firstOrFail();

    // Temukan tweet berdasarkan ID tweet
    $tweet = Tweets::findOrFail($tweetId);
    $comments = Comment::where('tweet_id', $tweetId)->get();

    return view('seepost', compact('user', 'tweet','comments'));
    }   
    
    public function commenstore(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'tweet_id' => 'required|exists:tweets,id'
        ]);
    
        Comment::create([
            'user_id' => Auth::id(),
            'tweet_id' => $request->tweet_id,
            'content' => $request->comment,
        ]);
    
        return back()->with('success', 'Comment added successfully.');
    }
    public function destroycomment(Comment $comment)
{
    // Pastikan pengguna yang mencoba menghapus komentar adalah pemilik komentar atau memiliki izin yang sesuai
    if ($comment->user_id == Auth::id()) {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully.');
    } else {
        return back()->with('error', 'You are not authorized to delete this comment.');
    }
}

  
    

}
