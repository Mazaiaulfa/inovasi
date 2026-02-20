@extends('layouts.auth')

@section('title', 'Lupa Password')

@push('style')
<link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
<style>
    body {
        background: linear-gradient(135deg, #667eea, #764ba2);
        min-height: 100vh;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        padding: 2rem;
        max-width: 400px;
        width: 100%;
        margin: 90px auto;
    }

    .login-card h4 {
        font-weight: 600;
        margin-bottom: 1rem;
        text-align: center;
        color: #4f46e5;
    }

    .btn-primary {
        background-color: #4f46e5;
        border-color: #4f46e5;
    }

    .btn-primary:hover {
        background-color: #3c3bb8;
        border-color: #3c3bb8;
    }
    .login-title {
    font-size: 1.3rem;        /* sedikit lebih besar dari default h4 */
    font-weight: 600;          /* lebih tebal dan tegas */
    text-align: center;
    color: #4f46e5;            /* warna utama tema */
    margin-bottom: 1.5rem;     /* beri jarak bawah agar rapi */
    letter-spacing: 0.5px;     /* sedikit spasi agar modern */
}

</style>
@endpush

@section('main')
<div class="login-card">
    {{-- Logo --}}
    <div class="login-brand text-center mb-3">
        <img src="{{ asset('img/logoLogin.png') }}" alt="Logo" style="height: 58px; width: auto;">
    </div>

<h6 class="login-title">Lupa Password</h6>


    <p class="text-center text-gray-600 mb-4">
        Masukkan email Anda, dan kami akan mengirimkan tautan untuk mereset password.
    </p>

    {{-- Status --}}
    @if (session('status'))
        <div class="alert alert-success text-center mb-3">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        {{-- Email --}}
        <div class="form-group mb-3">
            <label for="email" class="font-weight-bold"><i class="fas fa-envelope mr-1"></i> Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda">
            @error('email')
                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">
            Kirim Tautan Reset Password
        </button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}" class="text-small text-primary">
            Kembali ke Login
        </a>
    </div>
</div>
@endsection
