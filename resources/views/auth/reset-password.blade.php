@extends('layouts.auth')

@section('title', 'Reset Password')

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
    .login-title-small {
    font-size: 1.5rem;       /* sedikit lebih kecil dari h4 tapi tetap tegas */
    font-weight: 700;         /* tebal */
    text-align: center;
    color: #4f46e5;           /* warna tema */
    margin-bottom: 1.2rem;    /* jarak bawah */
    letter-spacing: 0.5px;    /* sedikit spasi modern */
}

</style>
@endpush

@section('main')
<div class="login-card">
    {{-- Logo --}}
    <div class="login-brand text-center mb-3">
        <img src="{{ asset('img/logoLogin.png') }}" alt="Logo" style="height: 58px; width: auto;">
    </div>

    <h6 class="login-title-small">Reset Password</h6>

    <p class="text-center text-gray-600 mb-4">
        Masukkan email dan password baru Anda.
    </p>

    {{-- Status --}}
    @if (session('status'))
        <div class="alert alert-success text-center mb-3">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Email --}}
        <div class="form-group mb-3">
            <label for="email" class="font-weight-bold"><i class="fas fa-envelope mr-1"></i> Email</label>
            <input id="email" type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email', $request->email) }}" required autofocus
                placeholder="Masukkan email Anda">
            @error('email')
                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password Baru --}}
        <div class="form-group mb-3">
            <label for="password" class="font-weight-bold"><i class="fas fa-lock mr-1"></i> Password Baru</label>
            <input id="password" type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password" placeholder="Masukkan password baru">
            @error('password')
                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div class="form-group mb-4">
            <label for="password_confirmation" class="font-weight-bold"><i class="fas fa-lock mr-1"></i> Konfirmasi Password</label>
            <input id="password_confirmation" type="password"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi password">
            @error('password_confirmation')
                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">
            Reset Password
        </button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}" class="text-small text-primary">
            Kembali ke Login
        </a>
    </div>
</div>
@endsection
