<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\user;
use App\Models\profile;
use App\Models\Tweets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function dashboard()
    {
        // Fetch tweets with related user and files, ordered by creation date
        $tweets = Tweets::with(['user.profile', 'files'])->orderBy('created_at', 'desc')->get();
        
        // Fetch users excluding the current authenticated user
        $users = User::where('id', '!=', auth()->id())->get();
    
        // Pass tweets and users to the view
        return view('dashboard', compact('tweets', 'users'));
    }


    
    public function index()
    {
        return view('login');
    } 


    public function loginUser(Request $request){
        // Lakukan validasi terlebih dahulu
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
        ]);
    
        // Jika validasi gagal, kembalikan dengan pesan kesalahan
        if($validator->fails()){
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }
    
        // Jika validasi berhasil, coba otentikasi
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success','Login berhasil');
        }else{
            return redirect()->route('login')->with('error','Login gagal, username atau password salah');
        }
    }

    public function register()
    {
        return view('register');
    }

   
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed', // Password confirmation
        ],[
            'username.required' => 'Username is required',
            'username.unique' => 'Username has already been taken',
            'nama.required' => 'Nama is required',
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email format',
            'email.unique' => 'Email has already been taken',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password confirmation does not match',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }
    
        // Buat pengguna baru
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        if ($user) {
            $profile = Profile::create([
                'nama' => $request->nama,
                'user_id' => $user->id,
            ]);
    
            if ($profile) {
                return redirect()->route('register')
                    ->with('success', 'User and profile created successfully');
            } else {
                $user->delete();
                return redirect()->route('register')
                    ->with('error', 'Failed to create profile');
            }
        } else {
            return redirect()->route('register')
                ->with('error', 'Failed to create user');
        }
}


public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}

}
