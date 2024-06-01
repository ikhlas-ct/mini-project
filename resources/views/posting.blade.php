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

        .navbar-content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .navbar-content .nav-link {
            margin: 0 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .border-container {
            border: 1px solid #202327;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            text-align: center;
            position: relative;
        }

        .image-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 200px;
            border: 2px dashed #6c757d;
            border-radius: 10px;
            color: #6c757d;
            cursor: pointer;
            font-size: 1.5rem;
        }

        .image-upload-label:hover {
            background-color: #333;
        }

        #file-upload {
            display: none;
        }

        .preview-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 10px;
            position: relative;
        }

        .preview-element {
            margin: 5px;
        }

        .preview-element img,
        .preview-element video {
            max-width: 100%;
            max-height: 200px;
            border-radius: 100%;
        }
    </style>

    <div class="row" style="height: 100vh">
        @include('partials._sidebar')

        <div class="col col-lg" style="border-right: 1px solid #202327">
            <nav class="navbar navbar-expand-lg ">
                <div class="container d-flex flex-column align-items-center">
                    <a class="navbar-brand mb-2" href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/logo-medsos.png') }}" alt="Logo" style="max-width: 100px; max-height: 50px;">
                    </a>
                    <div class="d-flex justify-content-center">
                        <a class="nav-link text-white mx-3" href="{{ route('dashboard') }}">For You</a>
                        <a class="nav-link text-white mx-3" href="#">Following</a>
                    </div>
                </div>
            </nav>

            <!-- New Tweet Input -->
            <div class="row justify-content-center mt-3">
                <div class="col-lg-8">
                    <div class="border-container">
                        <div class="d-flex align-items-start">
                            <div class="class img-fluid profile-image" style="height: 50px; width: 50px; border-radius: 50px">
                                @if (!empty(Auth::user()->profile->gambar_profil))
                                    <img src="{{ asset('storage/' . Auth::user()->profile->gambar_profil) }}" alt="Profile Image" class="img-fluid profile-image" style="width: 80px; height: 80px; border-radius: 100%;">
                                @else
                                    <img src="{{ asset('assets/default_profile.png') }}" alt="Default Profile Image" class="img-fluid profile-image" style="width: 80px; height: 80px; border-radius: 100%;">
                                @endif
                            </div>
                            <form action="{{ route('buat_tweet') }}" method="POST" enctype="multipart/form-data" class="w-100 ml-3">
                                @csrf
                                <div class="form-group">
                                    <textarea name="content" class="form-control bg-transparent text-white border-0 shadow-none" placeholder="Deskripsi postingan" rows="3"></textarea>
                                </div>
                                <label for="file">Klik Gambar</label>
                                <div class="form-group">
                                    <label for="file-upload" class="image-upload-label">
                                        <div class="preview-container"></div>
                                    </label>
                                    <input type="file" name="files[]" id="file-upload" multiple>
                                </div>
                                <div class="form-group preview-container" id="file-preview-container"></div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary" style="border-radius: 20px;">
                                        Posting
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End New Tweet Input -->

            <!-- All Tweets -->
            @foreach ($tweets as $tweet)
            <div class="row justify-content-evenly py-3" style="border-bottom: 1px solid #202327">
                <div class="col-lg d-flex flex-column">
                    <div class="d-flex align-items-center mb-1">
                        <div class="class img-fluid profile-image" style="height: 50px; width: 50px; border-radius: 50px">
                            @if (!empty($tweet->user->profile->gambar_profil))
                                <img src="{{ asset('storage/' . $tweet->user->profile->gambar_profil) }}" alt="Profile Image" class="img-fluid profile-image" style="width: 50px; height: 50px; border-radius: 50%;">
                            @else
                                <img src="{{ asset('assets/default_profile.png') }}" alt="Default Profile Image" class="img-fluid profile-image" style="width: 50px; height: 50px; border-radius: 50%;">
                            @endif
                        </div>
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
            </div>
            @endforeach
            <!-- End All Tweets -->

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        });

        document.getElementById('file-upload').addEventListener('change', function(event) {
            const files = event.target.files;
            const previewContainer = document.querySelector('.preview-container');
            previewContainer.innerHTML = '';

            for (const file of files) {
                const fileReader = new FileReader();
                fileReader.onload = function(e) {
                    const fileUrl = e.target.result;
                    const previewElement = document.createElement('div');
                    previewElement.classList.add('preview-element');

                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = fileUrl;
                        img.classList.add('img-fluid');
                        img.style.width = '100%';
                        img.style.height = 'auto';
                        img.style.borderRadius = '10%';
                        img.style.objectFit = 'cover';
                        previewElement.appendChild(img);
                    } else if (file.type.startsWith('video/')) {
                        const video = document.createElement('video');
                        video.src = fileUrl;
                        video.controls = true;
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
