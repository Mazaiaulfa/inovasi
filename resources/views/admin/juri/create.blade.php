@extends('layouts.app')
@section('title', 'Tambah Juri')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.main-content {
    padding-top: 20px;
}

.custom-card {
    max-width: 700px;
    margin: 0 auto;
}
</style>
@endpush

@section('main')
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">

            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="card shadow-sm custom-card">

                        {{-- HEADER --}}
                        <div class="card-header">
                            <h5 class="mb-0">Tambah Juri</h5>
                        </div>

                        {{-- BODY --}}
                        <div class="card-body">

                            <form action="{{ route('admin.juri.store') }}" method="POST">
                                @csrf

                                {{-- NAMA --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Nama</label>
                                    <input type="text"
                                           name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Masukkan nama juri"
                                           value="{{ old('name') }}"
                                           required>

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- EMAIL --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email"
                                           name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="contoh@email.com"
                                           value="{{ old('email') }}"
                                           required>

                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- PASSWORD --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Password</label>
                                    <input type="password"
                                           name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Minimal 6 karakter"
                                           required>

                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- BUTTON --}}
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.juri.index') }}" class="btn btn-secondary">
                                        Batal
                                    </a>

                                    <button type="submit" class="btn btn-primary px-4">
                                        Simpan
                                    </button>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
