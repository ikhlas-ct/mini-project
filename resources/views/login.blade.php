@extends('layouts.master')
@section('tittle', 'Login User')
@section('content')

<style>
  
    .login-logo img {
        width: 250px;
        height: auto;
        margin-bottom: 20px;
    }

    .register-link {
        margin-top: 50px;
    }
    footer {
        background-color: #fff;
        color: #000;
        text-align: center;
        padding: 10px;
        width: 100%;
        position: absolute;
        bottom: 0;
    }
    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }
    .footer-content img {
        width: 50px;
        height: auto;
        margin-right: 10px;
    }
    .custom-align {
    transform: translateY(-10%); /* Geser ke atas sebesar 25% dari posisi tengah */
}

</style>

<div class="container">
    <div class="row justify-content-center align-items-center custom-align" style="height: 100vh">
        <div class="col-md-4 d-flex justify-content-center ">
            <div class="login-logo">
                <img src="{{ asset('assets/logo-medsos.png') }}" alt="Logo">
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="login-box">
            <div class="mt-n5">
                <h2 class="text-center">Login</h2>
            </div>
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
                <form method="POST" action="{{ route('login_user')}}">
                    @csrf
                    <div class="mb-3 text-start">
                        <label for="username" class="form-label fw-bold text-white" >Username</label>
                        <input type="text" id="username" class="form-control" placeholder="Masukkan username" name="username" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Masukkan password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-light px-5 float-end ">Login</button>
                </form>
                <p class="register-link float-end">Belum punya akun? <a href="{{ route('register') }}" style="color: #fff;">Register</a></p>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="footer-content mt-5"> 
        <a href="#" class="d-flex align-items-center fw-bold text-dark fs-5">
            <img src="{{ asset('assets/logo-medsos.png') }}" alt="Logo">
            Tentang Kami
        </a>
        <div class="footer-kontak">
            <p class="fs-5 text-dark fw-bold">Kontak</p>
            <p class="">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio dicta alias voluptates id nemo debitis ipsum </p>

        </div>
    </div>
</footer>