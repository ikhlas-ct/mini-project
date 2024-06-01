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

        .trending-item:hover {
            background-color: #ffffff11;
            cursor: pointer;
        }

        .search-result-item {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #181818;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .search-result-item img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .search-result-item h6 {
            margin: 0;
            font-size: 16px;
        }

        .search-result-item span {
            color: #bbb;
        }

        .search-result-item a,
        .search-result-item form {
            margin-left: auto;
        }

        .search-result-item form button {
            padding: 5px 10px;
            border-radius: 20px;
            color: white;
            border: none;
        }

        .search-result-item form .btn-primary {
            background-color: #1c93e2;
        }

        .search-result-item form .btn-primary:hover {
            background-color: #21a6ff;
        }

        .search-result-item form .btn-danger {
            background-color: #e74c3c;
        }

        .search-result-item form .btn-danger:hover {
            background-color: #c0392b;
        }
    </style>
    <div class="row" style="height: 100vh">

        @include('partials._sidebar')

        <div class="col col-lg" style="border-right: 1px solid #202327">
            <nav class="navbar" style="display: flex; justify-content: center;">
                <a class="text-white text-decoration-none" href="#">
                    <img src="{{ asset('assets/logo-medsos.png') }}" alt="" style="max-width: 100px; max-height: 50px;">
                </a>
            </nav>

            <form action="{{ route('explre.show') }}" method="GET">
                <div class="row justify-content-evenly">
                    <div class="d-flex mb-3" style="width: 75%;">
                        <input type="text" name="query" class="form-control" placeholder="Cari user" aria-label="Cari user" aria-describedby="button-search" value="{{ request('query') }}" style="flex: 1 1 auto;">
                        <button class="btn btn-outline-secondary" type="submit" id="button-search" style="flex: 0 0 auto;">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="row mt-3">
                <div class="col-lg">
                    @if(request('query'))
                        <h5>Hasil pencarianmu</h5>
                        @if($searchResults->isEmpty())
                            <p>Tidak ada hasil pencarian untuk "{{ request('query') }}"</p>
                        @else
                        @foreach($searchResults as $result)
                        <div class="search-result-item">
                            <a href="{{ route('profile', ['username' => $result->username]) }}">
                                @if ($result->profile && $result->profile->gambar_profil)
                                    <img src="{{ asset('storage/' . $result->profile->gambar_profil) }}" alt="Profile Image">
                                @else
                                    <img src="{{ asset('assets/default_profile.png') }}" alt="Default Profile Image">
                                @endif
                            </a>
                            <div>
                                <h6>{{ $result->username }}</h6>
                                <span>{{ $result->profile->nama ?? 'No Name' }}</span>
                            </div>
                            @if (Auth::user()->following->contains($result->id))
                                <form action="{{ route('unfollow', ['id' => $result->id]) }}" method="POST" class="ms-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Unfollow</button>
                                </form>
                            @else
                                <form action="{{ route('follow', ['id' => $result->id]) }}" method="POST" class="ms-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Follow</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                    
                        @endif
                    @endif
                </div>
            </div>

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
@endpush
