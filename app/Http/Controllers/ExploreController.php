<?php

namespace App\Http\Controllers;

use App\Models\Tweets;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function explore_web(Request $request)
    {
    
        $user = Auth::user();
        $users = User::where('id', '!=', $user->id)->get();
        $query = $request->input('query');
        $searchResults = collect();

        if ($query) {
            // Pencarian berdasarkan nama atau username
            $searchResults = User::whereHas('profile', function ($queryBuilder) use ($query) {
                $queryBuilder->where('nama', 'LIKE', "%$query%");
            })->orWhere('username', 'LIKE', "%$query%")
              ->get();
        }

        // Menampilkan semua pengguna kecuali pengguna yang sedang login
        return view('explore', compact('user', 'users', 'searchResults', 'query'));



    }

  
}
