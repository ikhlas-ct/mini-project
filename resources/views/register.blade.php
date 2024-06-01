@extends('layouts.master')

@section('title', 'Register')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <!-- Logo -->
        <div class="col-md-4 text-center mb-3 mb-md-0">
            <img src="{{ asset('assets/logo-medsos.png') }}" alt="Logo" class="img-fluid" style="max-height: 100px;">
        </div>
        <!-- Form -->
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h1 class="mb-4">Register</h1>
            <form method="POST" action="{{ route('register_user') }}" id="password-form">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    <div id="password-error" class="text-danger mt-2" style="display:none;">Passwords do not match!</div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div class="d-flex justify-content-center mt-3">
                <p class="text-center">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold" style="color: #fff;">Login</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('password-form').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('password-confirm').value;
            var errorElement = document.getElementById('password-error');

            if (password !== confirmPassword) {
                event.preventDefault(); // Prevent form submission
                errorElement.style.display = 'block'; // Show error message
            } else {
                errorElement.style.display = 'none'; // Hide error message if passwords match
            }
        });
    });
</script>
@endpush
