@extends('layouts.auth')

@section('title', 'Login')

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
        margin-top: 90px;
    }

    .login-icon {
        font-size: 3rem;
        color: #4f46e5;
    }
</style>
@endpush

@section('main')
<div class="login-card">
    {{-- Logo --}}
    <div class="login-brand text-center mb-3">
        <img src="{{ asset('img/logoLogin.png') }}" alt="Logo" style="height: 58px; width: auto;">
    </div>

    {{-- Status --}}
    @if (session('status'))
        <div class="alert alert-success text-center">
            {{ session('status') }}
        </div>
    @endif

    {{-- Form Login --}}
    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
        @csrf

        {{-- Email --}}
        <div class="form-group mb-3">
            <label for="email" class="font-weight-bold"><i class="fas fa-envelope mr-1"></i> Email Team</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autofocus placeholder="Masukkan Email Team">
            @error('email')
                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group mb-2">
            <label for="password" class="font-weight-bold"><i class="fas fa-lock"></i> Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required placeholder="Masukkan Password">
            @error('password')
                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Lupa Password --}}
        <div class="text-right mb-3">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-small">Lupa Password?</a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary btn-lg btn-block">
            <i class="fas fa-sign-in-alt mr-1"></i> Log in
        </button>
    </form>

    {{-- Link Register --}}
    <div class="text-center mt-3">
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="text-small text-primary">
                <i class="fas fa-user-plus mr-1"></i> Belum Punya Akun?
            </a>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<!-- JS Libraries -->
@endpush
