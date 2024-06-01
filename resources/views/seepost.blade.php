@extends('layouts.master')
@section('title', 'Explore')
@section('content')
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

        html {
            scroll-behavior: smooth;
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Poppins";
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

        .profile-image {
            margin: 10px 8px;
        }

        .tweet-container {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 20px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .action-icons {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .action-icons i {
            cursor: pointer;
            color: #1da1f2;
            margin: 10px 0;
        }

        .action-icons i:hover {
            color: #0d8cd4;
        }

     

     
    </style>

    <div class="row" style="height: 100vh">
       
        @include('partials._sidebar')

        
        <div class="col-4 col-lg" style="">
            <nav class="navbar navbar-expand-lg ">
                <div class="container d-flex flex-column align-items-end">
                    <a class="navbar-brand mb-2" href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/logo-medsos.png') }}" alt="Logo" style="max-width: 100px; max-height: 50px;">
                    </a>
                </div>
            </nav>
            @if ($tweet)
            <div class="row justify-content-evenly py-3 ">
                <div class="tweet-container col-lg d-flex flex-column">
                    <div class="d-flex align-items-center mb-1">
                        <img src="{{ $tweet->user->profile ? asset('storage/' . $tweet->user->profile->gambar_profil) : asset('assets/default_profile.png') }}" class="img-fluid profile-image" style="height: 50px; width: 50px; border-radius: 50px; margin-right: 20px;" alt="Profile Image" />
                        <div>
                            <h6 class="mb-0">{{ $tweet->user->name }} <span class="text-secondary">{{ $tweet->user->username }} · {{ $tweet->created_at->format('M d') }}</span></h6>
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
                    
                </div>
            </div>
        @endif
        </div>

        <div class="col-5" style="">
            <div class="row justify-content-center" style="margin-top:; height: 80vh">
                <div class="col-lg-10">
                    @if($comments->count() > 0)
                    <div class="comments-section mt-4">
                        <h5>Komentar</h5>
                        @foreach ($comments as $comment)
                        <div class="comment mb-3 d-flex align-items-start">
                            <img src="{{ $comment->user->profile ? asset('storage/' . $comment->user->profile->gambar_profil) : asset('assets/default_profile.png') }}" class="img-fluid profile-image" style="height: 30px; width: 30px; border-radius: 50%; margin-right: 10px;" alt="Profile Image" />
                            <div>
                                <strong>{{ $comment->user->name }}</strong> <span class="text-secondary">{{ $comment->created_at->format('M d, Y H:i') }}</span>
                                <p>{{ $comment->content }}</p>
                            </div>
                        </div>
                        <!-- Tombol delete dan love -->
                        <div class="d-flex justify-content-between mb-3">
                                <button type="submit" class="btn btn-primary btn-sm" style="background-color: transparent; border-color:transparent; color: blue"><i class="fas fa-heart"></i> Likes</button>

                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="background-color: transparent; margin-right: 10px;border-color: transparent; color: red"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                            <!-- Tombol love -->
                          
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p>Belum Ada Komentar</p>
                    @endif
                    <hr>
             <div class="comment-form mt-4">
    <div class="d-flex justify-content-start align-items-center mb-3">
        <!-- Tombol like -->
        <form action="{{ $tweet->isLikedBy(Auth::user()) ? route('tweets.unlike', $tweet->id) : route('tweets.like', $tweet->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link text-decoration-none text-secondary" style="background: none; border: none;">
                @if ($tweet->isLikedBy(Auth::user()))
                    <i class="fa-solid fa-heart text-danger"></i>
                @else
                    <i class="fa-solid fa-heart"></i>
                @endif
            </button>
            <span>{{ $tweet->likes->count() }} Likes</span>
        </form>
        
        <!-- Tombol berbagi -->
        <button class="btn btn-link text-decoration-none text-secondary" style="background: none; border: none;"><i class="fa-solid fa-paper-plane"></i></button>
        
        <!-- Tombol pesan -->
        <button class="btn btn-link text-decoration-none text-secondary" style="background: none; border: none;"><i class="fas fa-envelope"></i></button>
    </div>
    
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
        <div class="form-group">
            <label for="comment">Add a Comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" required style="background-color: transparent; border: 1px solid #ced4da; color: white;"></textarea>
        </div>
        <button type="submit" class="btn btn-primary float-end" style="background: transparent; border: transparent;">Submit</button>
    </form>
</div>
                </div>
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
