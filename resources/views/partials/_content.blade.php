<!-- resources/views/partials/_content.blade.php -->

<div class="col col-lg" style="border-right: 1px solid #202327">
    <nav class="navbar" style="border-bottom: 1px solid #202327">
        <a class="text-white text-decoration-none" href="#">
            <h4>Home</h4>
        </a>
    </nav>
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
</div>
