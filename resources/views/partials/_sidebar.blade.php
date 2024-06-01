<!-- resources/views/partials/_sidebar.blade.php -->

<div class="col-3" style="border-right: 1px solid #202327">
    <div class="row justify-content-center align-items-center mt-5" style="height: 80vh">
        <div class="col-lg-10">
            <ul class="list-unstyled sidebar-menu-item">
                <a href="{{ route('my.Profile', ['username' => Auth::user()->username]) }}" class="clickable-div">
                    <div class="row menu-item align-items-center">
                        <div class="col-4">
                            @if (!empty(Auth::user()->profile->gambar_profil))
                                <img src="{{ asset('storage/' . Auth::user()->profile->gambar_profil) }}" alt="Profile Image" class="img-fluid profile-image" style="width: 80px; height: 80px; border-radius: 100%;">
                            @else
                                <img src="{{ asset('assets/default_profile.png') }}" alt="Default Profile Image" class="img-fluid profile-image" style="width: 80px; height: 80px; border-radius: 100%;">
                            @endif
                        </div>
                        <div class="col-8">
                            <span class="fw-bold">{{ Auth::user()->name }}</span>
                            <span>{{  Auth::user()->username }}</span>
                            <p class="text-white mb-0 mt-1" style="word-wrap: break-word; font-size: 12px;">{{ Auth::user()->profile->nama }}</p>
                        </div>
                    </div>
                </a>

                <hr class="text-white">

                <div class="row menu-item align-items-center">
                    <div class="col-lg-3 text-center">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="col-lg-9 d-none d-lg-block">
                        <a href="{{ route('dashboard') }}" class="text-decoration-none text-white">Beranda</a>
                    </div>
                </div>

                <div class="row menu-item align-items-center">
                    <div class="col-lg-3 text-center">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div class="col-lg-9 d-none d-lg-block">
                        <a href="{{ route('explre.show') }}" class="text-decoration-none text-white">Explore</a>
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
                        <a href="{{ route('posting.show', ['username' => Auth::user()->username]) }}" class="clickable-div">
                        Posting                       
                        </a>
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
                        <a href="{{ route('login') }}" class="text-decoration-none text-white" id="logout-link">Logout</a>
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

<style>
    .clickable-div {
        display: block;
        color: inherit;
        text-decoration: none;
    }

    .clickable-div .menu-item:hover {
        background-color: #181818;
        border-radius: 30px;
        cursor: pointer;
    }
</style>
