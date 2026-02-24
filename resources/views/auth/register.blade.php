@extends('layouts.auth')

@section('title', 'Register')

@push('style')
<!-- CSS Libraries -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

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

    }

    .login-icon {
        font-size: 3rem;
        color: #4f46e5;
    }
</style>
@endpush

@section('main')
<div class="login-card">
    {{-- Register Brand --}}
    <div class="login-brand mb-2 text-center">
        <img src="{{ asset('img/logoLogin.png') }}" alt="Logo" style="height: 58px; width: auto;">
    </div>

    {{-- Form Register --}}
    <form method="POST" action="{{ route('register') }}">
        @csrf

{{-- Jenis Peserta --}}
<div class="form-group mb-1">
    <label class="font-weight-bold">
        <i class="fas fa-layer-group mr-1"></i> Jenis Peserta
    </label>
    <select name="jenis_peserta" id="jenisPeserta"
        class="form-control @error('jenis_peserta') is-invalid @enderror" required>
        <option value="">-- Pilih Jenis Peserta --</option>
        <option value="EIF" {{ old('jenis_peserta') == 'EIF' ? 'selected' : '' }}>
            EIF (Individu)
        </option>
        <option value="GKM" {{ old('jenis_peserta') == 'GKM' ? 'selected' : '' }}>
            GKM (Team)
        </option>
    </select>

    @error('jenis_peserta')
    <div class="invalid-feedback" style="display:block">
        {{ $message }}
    </div>
    @enderror
</div>

        {{-- Nama Team --}}
<div class="form-group mb-1">
    <label id="labelName" for="name" class="font-weight-bold">
        <i class="fas fa-users mr-1"></i> Nama Team
    </label>

    <input id="name"
        type="text"
        class="form-control @error('name') is-invalid @enderror"
        name="name"
        value="{{ old('name') }}"
        required
        placeholder="Masukkan Nama Team">

    @error('name')
    <div class="invalid-feedback" style="display:block">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group mb-1">
    <label for="unit_kerja" class="font-weight-bold">
        <i class="fas fa-building mr-1"></i> Unit Kerja
    </label>
    <select id="unit_kerja"
        name="unit_kerja"
        class="form-control select2 @error('unit_kerja') is-invalid @enderror"
        required>

        <option value="">-- Pilih Unit Kerja --</option>

        <option value="Departement Pengawasan"
            {{ old('unit_kerja') == 'Departement Pengawasan' ? 'selected' : '' }}>
            Departement Pengawasan
        </option>

          <option value="Departement QA, Perencanaan & Pelaporan"
            {{ old('unit_kerja') == 'Departement QA, Perencanaan & Pelaporan' ? 'selected' : '' }}>
            Departement QA, Perencanaan & Pelaporan
        </option>

        <option value="Departement Komunikasi & Administrasi Korporat"
            {{ old('unit_kerja') == 'Departement Komunikasi & Administrasi Korporat' ? 'selected' : '' }}>
            Departement Komunikasi & Administrasi Korporat
        </option>

        <option value="Departement TJSL"
            {{ old('unit_kerja') == 'Departement TJSL' ? 'selected' : '' }}>
            Departement TJSL
        </option>

        <option value="Kantor Perwakilan Jakarta"
            {{ old('unit_kerja') == 'Kantor Perwakilan Jakarta' ? 'selected' : '' }}>
            Kantor Perwakilan Jakarta
        </option>

        <option value="Departement Sistem Manajemen Terpadu & Inovasi"
            {{ old('unit_kerja') == 'Departement Sistem Manajemen Terpadu & Inovasi' ? 'selected' : '' }}>
            Departement Sistem Manajemen Terpadu & Inovasi
        </option>

        <option value="Departement Pengelola Pelanggan"
            {{ old('unit_kerja') == 'Departement Pengelola Pelanggan' ? 'selected' : '' }}>
            Departement Pengelola Pelanggan
        </option>

        <option value="Staf Riset"
            {{ old('unit_kerja') == 'Staf Riset' ? 'selected' : '' }}>
            Staf Riset
        </option>

        <option value="Staf Transformasi Bisnis"
            {{ old('unit_kerja') == 'Staf Transformasi Bisnis' ? 'selected' : '' }}>
            Staf Transformasi Bisnis
        </option>

        <option value="Project Manager"
            {{ old('unit_kerja') == 'Project Manager' ? 'selected' : '' }}>
            Project Manager
        </option>
        <option value="Departemen keauangan & Anggaran"
            {{ old('unit_kerja') == 'Departemen keauangan & Anggaran' ? 'selected' : '' }}>
            Departemen keauangan & Anggaran
        </option>
         <option value="Departement Akutansi"
            {{ old('unit_kerja') == 'Departement Akutansi' ? 'selected' : '' }}>
            Departement Akutansi
        </option>
         <option value="Departement Administrasi Pemasaran & Penjualan"
            {{ old('unit_kerja') == 'Departement Administrasi Pemasaran & Penjualan' ? 'selected' : '' }}>
            Departement Administrasi Pemasaran & Penjualan
        </option>
           <option value="Departement Operasional SDM"
            {{ old('unit_kerja') == 'Departement Operasional SDM' ? 'selected' : '' }}>
            Departement Operasional SDM
        </option>
         <option value="Departement Manajemen & Pengembangan SDM"
            {{ old('unit_kerja') == 'Departement Manajemen & Pengembangan SDM' ? 'selected' : '' }}>
            Departement Manajemen & Pengembangan SDM
        </option>
           <option value="Departement Pelayanan Umum"
            {{ old('unit_kerja') == 'Departement Pelayanan Umum' ? 'selected' : '' }}>
            Departement Pelayanan Umum
        </option>
           <option value="Departement keamanan"
            {{ old('unit_kerja') == 'Departement keamanan' ? 'selected' : '' }}>
            Departement keamanan
        </option>
          <option value="Departemen Perencanaan, penerimaan, & pergudangan"
            {{ old('unit_kerja') == 'Departemen Perencanaan, penerimaan, & pergudangan' ? 'selected' : '' }}>
           Departemen Perencanaan, penerimaan, & pergudangan
        </option>
           <option value="Departemen Pengadaan barang & Jasa"
            {{ old('unit_kerja') == 'Departemen Pengadaan barang & Jasa' ? 'selected' : '' }}>
            Departemen Pengadaan barang & Jasa
        </option>
           <option value="Departemen Manajemen Resiko"
            {{ old('unit_kerja') == 'Departemen Manajemen Resiko' ? 'selected' : '' }}>
           Departemen Manajemen Resiko
        </option>
           <option value="Staf Tata Kelola & Kepatuhan"
            {{ old('unit_kerja') == 'Staf Tata Kelola & Kepatuhan' ? 'selected' : '' }}>
            Staf Tata Kelola & Kepatuhan
        </option>
           <option value="Departement Hukum"
            {{ old('unit_kerja') == 'Departement Hukum' ? 'selected' : '' }}>
            Departement Hukum
        </option>
           <option value="Departemen Operasi Pabrik -1"
            {{ old('unit_kerja') == 'Departemen Operasi Pabrik -1' ? 'selected' : '' }}>
           Departemen Operasi Pabrik -1
        </option>
           <option value="Departemen Operasi Pabrik-2"
            {{ old('unit_kerja') == 'Departemen Operasi Pabrik-2' ? 'selected' : '' }}>
           Departemen Operasi Pabrik-2
        </option>
          </option>
           <option value="Departemen Operasi Pabrik -3"
            {{ old('unit_kerja') == 'Departemen Operasi Pabrik -3' ? 'selected' : '' }}>
           Departemen Operasi Pabrik -3
        </option>
           <option value="Departemen Proses & Pengelola Energi"
            {{ old('unit_kerja') == 'Departemen Proses & Pengelola Energi' ? 'selected' : '' }}>
           Departemen Proses & Pengelola Energi
        </option>
             <option value="Departement Inspeksi Teknik & Kendala"
            {{ old('unit_kerja') == 'Departement Inspeksi Teknik & Kendala' ? 'selected' : '' }}>
           Departement Inspeksi Teknik & Kendala
        </option>
          </option>
           <option value="Departemen K3LH"
            {{ old('unit_kerja') == 'Departemen K3LH' ? 'selected' : '' }}>
           Departemen K3LH
        </option>
           <option value="Departemen Perencanaan Pengendalian Pemeliharaan"
            {{ old('unit_kerja') == 'Departemen Perencanaan Pengendalian Pemeliharaan' ? 'selected' : '' }}>
           Departemen Perencanaan Pengendalian Pemeliharaan
        </option>
              <option value="Departemen Pemeliharaan Mekanik, listrik & Instrumen"
            {{ old('unit_kerja') == 'Departemen Pemeliharaan Mekanik, listrik & Instrumen' ? 'selected' : '' }}>
          Departemen Pemeliharaan Mekanik, listrik & Instrumen
        </option>
          </option>
           <option value="Departemen Perbengkelan & Peralatan"
            {{ old('unit_kerja') == 'Departemen Perbengkelan & Peralatan' ? 'selected' : '' }}>
         Departemen Perbengkelan & Peralatan
        </option>
           <option value="Departemen Jasa Pelayan Pabrik"
            {{ old('unit_kerja') == 'Departemen Jasa Pelayan Pabrik' ? 'selected' : '' }}>
           Departemen Jasa Pelayan Pabrik
        </option>

               <option value="Spesialis"
            {{ old('unit_kerja') == 'Spesialis' ? 'selected' : '' }}>
          Spesialis
        </option>
          </option>
           <option value="Departement pengembangan Bisnis"
            {{ old('unit_kerja') == 'Departement pengembangan Bisnis' ? 'selected' : '' }}>
         Departement pengembangan Bisnis
        </option>
           <option value="Departement Rancang Bangun"
            {{ old('unit_kerja') == 'Departement Rancang Bangun' ? 'selected' : '' }}>
           Departement Rancang Bangun
        </option>
    </select>

    <small class="text-danger">
        <i class="fas me-1"></i>
        *Pilih unit kerja.
    </small>

    @error('unit_kerja')
    <div class="invalid-feedback" style="display:block">
        {{ $message }}
    </div>
    @enderror



        {{-- Email Team --}}
        <div class="form-group mb-1">
            <label for="email" class="font-weight-bold"><i class="fas fa-envelope mr-1"></i> Email Team</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required placeholder="Masukkan Email Team">
            @error('email')
            <div class="invalid-feedback" style="display:block">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group mb-1">
            <label for="password" class="font-weight-bold"><i class="fas fa-lock mr-1"></i> Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required placeholder="Masukkan Password">
            @error('password')
            <div class="invalid-feedback" style="display:block">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="form-group mb-3">
            <label for="password_confirmation" class="font-weight-bold"><i class="fas fa-lock mr-1"></i> Konfirmasi
                Password</label>
            <input id="password_confirmation" type="password"
                class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                required placeholder="Konfirmasi Password">
            @error('password_confirmation')
            <div class="invalid-feedback" style="display:block">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary btn-lg btn-block">
            <i class="fas fa-user-plus mr-1"></i> Register
        </button>
    </form>

    {{-- Link Login --}}
    <div class="text-center mt-3">
        <a href="{{ route('login') }}" class="text-small text-primary">
            <i class="fas fa-sign-in-alt mr-1"></i> Sudah Punya Akun?
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    const jenis = document.getElementById("jenisPeserta");
    const label = document.getElementById("labelName");
    const input = document.getElementById("name");

    function ubahLabel() {
        if (jenis.value === "EIF") {
            label.innerHTML = '<i class="fas fa-user mr-1"></i> Nama Peserta';
            input.placeholder = "Masukkan Nama Peserta";
        } else if (jenis.value === "GKM") {
            label.innerHTML = '<i class="fas fa-users mr-1"></i> Nama Team';
            input.placeholder = "Masukkan Nama Team";
        }
    }

    jenis.addEventListener("change", ubahLabel);

    ubahLabel(); // supaya tetap sesuai kalau reload
});
</script>

@endpush




