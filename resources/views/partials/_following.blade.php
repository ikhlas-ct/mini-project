<div class="col-lg-4 ps-5" style="height: 80vh; overflow-y: scroll;">
    <div class="row">
        <div class="col-lg-10 mt-3">
            <h5>Siapa yang harus diikuti</h5>
            <span class="text-secondary">Orang yang mungkin anda kenal</span>

            @foreach ($users as $user)
                <div class="row p-2 trending-item rounded-4 mt-2" >
                    <div class="col d-flex align-items-center">
                        @if ($user->profile && $user->profile->gambar_profil)
                        <img src="{{ asset('storage/' . $user->profile->gambar_profil) }}" alt="Profile Image" class="img-fluid profile-image" style="width: 50px; height: 50px; border-radius: 50%;">
                    @else
                        <img src="{{ asset('assets/default_profile.png') }}" alt="Default Profile Image" class="img-fluid profile-image" style="width: 50px; height: 50px; border-radius: 50%;">
                    @endif                        <div class="ms-3">
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
