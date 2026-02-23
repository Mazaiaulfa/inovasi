@extends('layouts.app')

@section('title', 'Profile Saya')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile Saya</h1>
        </div>

        <div class="section-body">
            <div class="row">

                <!-- UPDATE PROFILE -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                        </div>

                        <div class="card-body">

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('admin.profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Nama Gugus</label>
                                    <input type="text" name="name"
                                        class="form-control"
                                        value="{{ old('name', Auth::user()->name) }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Unit Kerja</label>
                                    <input type="text" name="unit_kerja"
                                        class="form-control"
                                        value="{{ old('unit_kerja', Auth::user()->unit_kerja) }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email"
                                        class="form-control"
                                        value="{{ old('email', Auth::user()->email) }}"
                                        required>
                                </div>

                                <hr>
                                <h6>Ganti Password (Opsional)</h6>
                                <small class="text-muted">
                                    Kosongkan jika tidak ingin mengganti password.
                                </small>

                                <div class="form-group mt-2">
                                    <label>Password Baru</label>
                                    <input type="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Isi jika ingin mengganti password">
                                </div>

                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input type="password"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Ulangi password baru">
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- DELETE ACCOUNT -->
                <div class="col-md-4">
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            <h4>Hapus Akun</h4>
                        </div>

                        <div class="card-body">
                            <p class="text-danger">
                                Menghapus akun akan menghapus semua data secara permanen.
                            </p>

                            <form action="{{ route('admin.profile.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <div class="form-group">
                                    <label>Masukkan Password</label>
                                    <input type="password"
                                        name="password"
                                        class="form-control"
                                        required>
                                </div>

                                <button type="submit"
                                    class="btn btn-danger btn-block"
                                    onclick="return confirm('Yakin ingin menghapus akun?')">
                                    Hapus Akun
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
