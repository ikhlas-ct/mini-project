@extends('layouts.master')
@section('title', 'Edit Profile')
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
    }

    .profile-header {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        border-bottom: 1px solid #202327;
        flex-direction: column;
        position: relative;
    }

    .profile-header img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 10px;
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

    .form-container {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        color: #fff;
        background-color: transparent;
        border: 1px solid #ccc;
    }

    .btn {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #21a6ff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #1c93e2;
    }
</style>

<div class="row" style="height: 100vh">
    @include('partials._sidebar')
    <div class="col-8 d-inline-flex align-items-center justify-content-center flex-column">
        <div class="profile-header">
            <img src="{{ $user->profile->gambar_profil ? asset('storage/' . $user->profile->gambar_profil) : asset('assets/default_profile.png') }}" alt="Profile Image" id="profileImagePreview">
            <div>
                <h4 class="fw-bold text-white">Edit Profile</h4>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="form-container">
            <form id="editForm" action="{{ route('profile.update', ['username' => $user->username]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="username" class="text-white">Username</label>
                    <input type="text" id="username" class="form-control bg-transparent text-white" value="{{ $user->username }}" disabled>
                </div>
                <div class="form-group">
                    <label for="profile_image" class="text-white">Profile Image</label>
                    <input type="file" id="profile_image" name="profile_image" class="form-control bg-transparent text-white" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="name" class="text-white">Nama</label>
                    <input type="text" id="name" name="name" class="form-control bg-transparent text-white" value="{{ $user->profile->nama ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="bio" class="text-white">Bio</label>
                    <textarea id="bio" name="bio" class="form-control bg-transparent text-white">{{ $user->profile->bio  ?? '' }}</textarea>
                </div>
                <button id="editButton" type="submit" class="btn btn-primary float-end">Edit</button>
            </form>
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