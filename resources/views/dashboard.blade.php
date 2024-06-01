@extends('layouts.master')
@section('title','Dashboard')
@section('content')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

    html {
        scroll-behavior: smooth;
    }

    * {
        margin: 0 0;
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

    .trending-item:hover {
        background-color: #ffffff11;
        cursor: pointer;
    }

</style>
<div class="row" style="height: 100vh">

@include('partials._sidebar')

<div class="col col-lg" style="border-right: 1px solid #202327">
    <nav class="navbar" style="border-bottom: 1px solid #202327">
        <a class="text-white text-decoration-none" href="route{{route('dashboard')}}">
            <h4>Home</h4>
        </a>
    </nav>
    <div class="row justify-content-evenly" style="border-bottom: 1px solid #202327">
        <div class="col-lg d-flex">
            <div class="class img-fluid profile-image" style="height: 50px; width: 50px; border-radius: 50px">
                @if (!empty(Auth::user()->profile->gambar_profil))
                    <img src="{{ asset('storage/' . Auth::user()->profile->gambar_profil) }}" alt="Profile Image" class="img-fluid profile-image" style="width: 80px; height: 80px; border-radius: 100%;">
                @else
                    <img src="{{ asset('assets/default_profile.png') }}" alt="Default Profile Image" class="img-fluid profile-image" style="width: 80px; height: 80px; border-radius: 100%;">
                @endif
            </div>
            <form action="{{ route('buat_tweet') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column w-100 mt-3">
                @csrf
                <div class="input-group">
                    <textarea name="content" class="form-control bg-transparent text-white border-0 shadow-none" placeholder="What's happening?" aria-label="With textarea"></textarea>
                </div>
                <div class="row mt-2">
                    <div class="col-1 col-lg-1"></div>
                    <div class="col col-lg d-flex align-items-center">
                        <label for="file-upload" class="text-decoration-none" style="color: #21a6ff; cursor: pointer;">
                            <i class="fa-solid fa-image mt-2 mb-3" style="margin-right: 10px"></i>
                        </label>
                        <input type="file" name="files[]" id="file-upload" multiple class="d-none">
                    </div>
                    <div class="col-lg-1 d-flex align-items-center justify-content-end">
                        <button type="submit" class="btn btn-primary" style="border-radius: 20px;">
                            Post
                        </button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div id="file-preview-container" class="col-12 d-flex flex-wrap"></div>
                </div>
            </form>
        </div>
    </div>
    
  
    <!-- End New Tweet Input -->
    <!-- All Tweets -->
    @foreach ($tweets as $tweet)
    <div class="row justify-content-evenly py-3" style="border-bottom: 1px solid #202327">
        <div class="col-lg d-flex flex-column">
            <div class="d-flex align-items-center mb-1">
                <!-- Profile Image -->
                @if ($tweet->user->profile?->gambar_profil)
                    <img src="{{ asset('storage/' . $tweet->user->profile->gambar_profil) }}" alt="Profile Image" class="img-fluid profile-image" style="width: 50px; height: 50px; border-radius: 50%;">
                @else
                    <img src="{{ asset('assets/default_profile.png') }}" alt="Default Profile Image" class="img-fluid profile-image" style="width: 50px; height: 50px; border-radius: 50%;">
                @endif
                <!-- User Information -->
                <div>
                    <h6 class="mb-0">{{ $tweet->user->name }} <span class="text-secondary">{{ $tweet->user->username }} · {{ $tweet->created_at->format('M d') }}</span></h6>
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
                <!-- Link to See Post -->
                <div class="col-3 col-lg-3">
                    <a href="{{ route('seepost.show', ['username' => $tweet->user->username, 'tweet' => $tweet->id]) }}" class="text-decoration-none text-secondary">
                        <i class="fa-regular fa-comment"></i>
                    </a>
                </div>
                <!-- Like Button -->
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
@endforeach

</div>

@include('partials._following')
</div>

@endsection

@push('scripts')

<script>
    document.getElementById('logout-link').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    });
</script>

<script>
    document.getElementById('file-upload').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('file-preview-container');
        previewContainer.innerHTML = ''; // Clear any existing previews

        for (const file of files) {
            const fileReader = new FileReader();
            fileReader.onload = function(e) {
                const fileUrl = e.target.result;
                const previewElement = document.createElement('div');
                previewElement.style.margin = '5px';
                
                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = fileUrl;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    previewElement.appendChild(img);
                } else if (file.type.startsWith('video/')) {
                    const video = document.createElement('video');
                    video.src = fileUrl;
                    video.controls = true;
                    video.style.width = '100px';
                    video.style.height = '100px';
                    previewElement.appendChild(video);
                } else {
                    const fileName = document.createElement('p');
                    fileName.textContent = file.name;
                    previewElement.appendChild(fileName);
                }

                previewContainer.appendChild(previewElement);
            };
            fileReader.readAsDataURL(file);
        }
    });
</script>
    
@endpush
