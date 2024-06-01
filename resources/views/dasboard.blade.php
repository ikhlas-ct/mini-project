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
    <div class="col-3" style="border-right: 1px solid #202327">
        <div class="row justify-content-center align-items-center mt-5" style="height: 80vh">
            <div class="col-lg-10">
                <ul class="list-unstyled sidebar-menu-item">
                    <div class="row menu-item align-items-center">
                        <div class="col-4">
                            @if (!empty(Auth::user()->profile_picture))
                                <img src="{{ asset(Auth::user()->profile_picture) }}" alt="Profile Image" class="img-fluid profile-image" style="width: 80px; height: 80px; border-radius: 100%;">
                            @else
                                <img src="{{ asset('assets/default_profile.png') }}" alt="Default Profile Image" class="img-fluid profile-image" style="width: 80px; height: 80px; border-radius: 100%;">
                            @endif
                        </div>
                        
                        <div class="col-8">
                            <a href="#" class="text-decoration-none text-white fs-6 d-flex flex-column">
                                <span class="fw-bold">{{ Auth::user()->name }}</span><span>{{ '@' . Auth::user()->username }}</span>
                            </a>
                            <p class="text-white mb-0 mt-1" style="word-wrap: break-word; font-size: 12px;">{{ Auth::user()->profile->nama }}</p>
                        </div>
                    </div>

                    <hr class="text-white">

                    <div class="row menu-item align-items-center">
                        <div class="col-lg-3 text-center">
                            <i class="fa-solid fa-house"></i>
                        </div>
                        <div class="col-lg-9 d-none d-lg-block">
                            <a href="{{route('dashboard')}}" class="text-decoration-none text-white">Beranda</a>
                        </div>
                    </div>

                    <div class="row menu-item align-items-center">
                        <div class="col-lg-3 text-center">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <div class="col-lg-9 d-none d-lg-block">
                            <a href="{{route('explre.show')}}" class="text-decoration-none text-white">Explore</a>
                        </div>
                    </div>
                    <div class="row menu-item align-items-center">
                        <div class="col-lg-3 text-center">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                        <div class="col-lg-9 d-none d-lg-block">
                            <a href="" class="text-decoration-none text-white">Notification</a>
                        </div>
                    </div>
                    <div class="row menu-item align-items-center">
                        <div class="col-lg-3 text-center">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="col-lg-9 d-none d-lg-block">
                            <a href="" class="text-decoration-none text-white">Posting</a>
                        </div>
                    </div>
                    <div class="row menu-item align-items-center">
                        <div class="col-lg-3 text-center">
                            <i class="fa-solid fa-bookmark"></i>
                        </div>
                        <div class="col-lg-9 d-none d-lg-block">
                            <a href="" class="text-decoration-none text-white">Bookmark</a>
                        </div>
                    </div>
                  <!-- Logout Button with Icon -->
                <div class="row menu-item align-items-center">
                    <div class="col-lg-3 text-center">
                        <i class="fa-solid fa-sign-out-alt"></i> <!-- Logout icon -->
                    </div>
                    <div class="col-lg-9 d-none d-lg-block">
                        <a href="{{route('login')}}" class="text-decoration-none text-white" id="logout-link">Logout</a>
                    </div>
                </div>

                <!-- Hidden Logout Form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

               
                </ul>
            </div>

        </div>
    </div>
    <div class="col col-lg" style="border-right: 1px solid #202327">
        <nav class="navbar" style="border-bottom: 1px solid #202327">
            <a class="text-white text-decoration-none" href="#">
                <h4>Home</h4>
            </a>
        </nav>
        <!-- New Tweet Input -->
        <div class="row justify-content-evenly" style="border-bottom: 1px solid #202327">
            <div class="col-lg d-flex">
                <img src="{{ asset('assets/default_profile.png') }}" class="img-fluid profile-image" style="height: 50px; width: 50px; border-radius: 50px" alt="" />
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
                    <img src="{{ asset('assets/default_profile.png') }}" class="img-fluid profile-image" style="height: 50px; width: 50px; border-radius: 50px; margin-right: 20px;" alt="" />
                    <div>
                        <h6 class="mb-0">{{ $tweet->user->name }} <span class="text-secondary">{{$tweet->user->username }} · {{ $tweet->created_at->format('M d') }}</span></h6>
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
        @endforeach
 
        <!-- End All Tweets -->
    </div>

    <div class="col-lg-4 ps-5" style="height: 80vh; overflow-y: scroll;">
        <div class="row">
            <div class="col-lg-10 mt-3">
                <h5>Siapa yang harus diikuti</h5>
                <span class="text-secondary">Orang yang mungkin anda kenal</span>
    
                @foreach ($users as $user)
                    <div class="row p-2 trending-item rounded-4 mt-2" style="border: 1px solid #202327;">
                        <div class="col d-flex align-items-center">
                            <img src="{{ asset('assets/default_profile.png') }}" alt="Profile Image" class="img-fluid profile-image" style="width: 50px; height: 50px; border-radius: 50%;">
                            <div class="ms-3">
                                <h6>{{ $user->username }}</h6>
                                <span class="text-secondary">{{ $user->name }}</span>
                            </div>
                            @if (Auth::user()->following->contains($user->id))
                                <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST" class="ms-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Unfollow</button>
                                </form>
                            @else
                                <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST" class="ms-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Follow</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
    
                <div class="row mt-3">
                    <div class="col">
                        <span class="text-secondary" style="font-size: 12px;">
                            Terms of Service Privacy Policy Cookie Policy Accessibility Ads info More © 2024 Sosmed
                        </span>
                    </div>
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
