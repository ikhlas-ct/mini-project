@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

    html {
        scroll-behavior: smooth;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "Poppins", sans-serif;
        background-color: #000000;
        color: #fff;
    }

    .nav-link {
        color: white;
    }

    .nav-link:hover {
        color: gray;
    }

    .sidebar-menu-item {
        font-size: 23px;
    }

    .sidebar-menu-item li {
        padding: 10px 10px;
    }

    .sidebar-menu-item .menu-item {
        padding: 10px;
        width: 98%;
        margin-bottom: 10px;
    }

    .sidebar-menu-item .menu-item:hover {
        background-color: #181818;
        border-radius: 30px;
        cursor: pointer;
    }

    .tweet-button {
        background-color: #21a6ff;
        border-radius: 30px;
        cursor: pointer;
        padding: 10px;
    }

    .tweet-button:hover {
        background-color: #1c93e2;
        border-radius: 30px;
        cursor: pointer;
        padding: 10px;
    }

    .profile-header {
        display: flex;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #202327;
    }

    .profile-header img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-right: 20px;
    }

    .profile-header h3 {
        margin: 0;
        font-size: 24px;
    }

    .profile-header p {
        margin: 5px 0;
        color: #bbb;
    }

    .profile-stats {
        text-align: center;
        margin: 20px 0;
    }

    .profile-stats span {
        margin: 0 10px;
        font-size: 16px;
        
    }

    .profile-content {
        text-align: center;
        margin-top: 40px;
    }

    .profile-content h4 {
        color: #bbb;
    }
    .stats {
    color: gray;
}
.modal-title {
        color: white;
        font-weight: bold;
    }


</style>
<div class="row" style="height: 100vh">
    @include('partials._sidebar')

    <div class="col-8" style="border-right: 1px solid #202327">
        <div class="profile-header">
            <div class="">
                @if (!empty(Auth::user()->profile->gambar_profil))
                    <img src="{{ asset('storage/' . Auth::user()->profile->gambar_profil) }}" alt="Profile Image" class="img-fluid profile-image" style="width: 80px; height: 80px; border-radius: 100%;">
                @else
                    <img src="{{ asset('assets/default_profile.png') }}" alt="Default Profile Image" class="img-fluid profile-image" style="width: 80px; height: 80px; border-radius: 100%;">
                @endif
            </div>            <div>
                <h3>{{ $user->username }}</h3>
                <p>{{ $user->profile->nama ?? 'No Name' }}</p>
                <div class="stats">
                    <span>{{ $user->tweets->count() }} Posts</span> |
                    <span>{{ $user->followers->count() }} Followers</span> |
                    <span>{{ $user->following->count() }} Following</span>
                </div>
            </div>
            <div class="d-flex align-items-center ms-auto">
                <a href="{{ route('profile.edit', ['username' => $user->username]) }}" class="text-decoration-none text-secondary" data-bs-toggle="modal" data-bs-target="#passwordModal">
                    <i class="fas fa-cog"></i>
                </a>
            </div>
            
            <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #000; color: #fff;">
                            <h5 class="modal-title" id="passwordModalLabel">Konfirmasi Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="background-color: #000; color: #fff;">
                            <form id="password-confirm-form" method="POST" action="{{ route('confirm-password') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="password" class="fw-bold">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="submit" class="btn btn-primary me-2">Konfirmasi</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    
        <div class="profile-content mt-4">
            @forelse ($user->tweets as $tweet)
                <div class="row justify-content-evenly py-3" style="border-bottom: 1px solid #202327">
                    <div class="col-lg d-flex flex-column">
                        <div class="d-flex align-items-center mb-1">                          
                            <div class="img-fluid profile-image" style="height: 50px; width: 50px; border-radius: 50px; margin-right: 20px;" alt="" >
                                @if (!empty(Auth::user()->profile->gambar_profil))
                                    <img src="{{ asset('storage/' . Auth::user()->profile->gambar_profil) }}" alt="Profile Image" class="img-fluid profile-image" style="width: 80px; height: 80px; border-radius: 100%;">
                                @else
                                    <img src="{{ asset('assets/default_profile.png') }}" alt="Default Profile Image" class="img-fluid profile-image" style="width: 80px; height: 80px; border-radius: 100%;">
                                @endif
                            </div>  

                            <div>
                                <h6 class="mb-0">{{ $user->name }} <span class="text-secondary">{{ $user->username }} · {{ $tweet->created_at->format('M d') }}</span></h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg">
                            <p class="m-lg-0 mb-0 ml-auto">{{ $tweet->content }}</p>
                        </div>
                    </div>
                    @foreach ($tweet->files as $file)
                        @if (Str::endsWith($file->file_path, ['.jpg', '.jpeg', '.png', '.gif']))
                            <div class="row mb-3">
                                <div class="col-lg d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('storage/' . $file->file_path) }}" alt="Tweet Image" class="img-fluid" style="max-width: 100%; max-height:600px">
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="row mb-3">
                        <div class="col-1 col-lg-1"></div>
                        <div class="col col-lg d-flex">
                            <div class="col-3 col-lg-3">
                                <a href="" class="text-decoration-none text-secondary">
                                    <i class="fa-regular fa-comment"></i>
                                </a>
                            </div>
                            <form action="{{ $tweet->isLikedBy(Auth::user()) ? route('tweets.unlike', $tweet->id) : route('tweets.like', $tweet->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-decoration-none text-secondary" style="background: none; border: none;">
                                    @if ($tweet->isLikedBy(Auth::user()))
                                        <i class="fa-solid fa-heart text-danger"></i>
                                    @else
                                        <i class="fa-solid fa-heart"></i>
                                    @endif
                                </button>
                            </form>
                            <p>{{ $tweet->likes->count() }} Likes</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="profile-content mt-4">
                    <h4>Belum ada postingan yang dapat ditampilkan</h4>
                </div>
            @endforelse
        </div>
    </div>
    


</div>
@endsection

@push('scripts')
<script>
    document.getElementById('logout-link').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    });
</script>
@endpush
