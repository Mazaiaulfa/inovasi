@extends('layouts.app')
@section('title', 'Tambah Pengumuman')

@section('main')
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card" style="max-width: 900px; margin: 0 auto;">
                        <div class="card-header">
                            <h4 class="m-0">Tambah Pengumuman</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- ================= JUDUL ================= --}}
                                <div class="form-group mb-4">
                                    <label for="judul" class="form-label fw-bold">
                                        Judul Pengumuman
                                    </label>
                                    <input type="text"
                                           name="judul"
                                           id="judul"
                                           class="form-control @error('judul') is-invalid @enderror"
                                           placeholder="Contoh: Pendaftaran Lomba Inovasi Mahasiswa 2026"
                                           value="{{ old('judul') }}"
                                           required>

                                    <small class="text-muted">
                                        Isi dengan judul singkat dan jelas.
                                    </small>

                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                {{-- ================= RINGKASAN ================= --}}
                                <div class="form-group mb-4">
                                    <label for="ringkasan" class="form-label fw-bold">
                                        Ringkasan
                                    </label>
                                    <textarea name="ringkasan"
                                              id="ringkasan"
                                              rows="2"
                                              class="form-control @error('ringkasan') is-invalid @enderror"
                                              placeholder="Tuliskan ringkasan singkat pengumuman (opsional)">{{ old('ringkasan') }}</textarea>

                                    <small class="text-muted">
                                        Maksimal 1–2 kalimat untuk preview di halaman utama.
                                    </small>

                                    @error('ringkasan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                {{-- ================= ISI ================= --}}
                                <div class="form-group mb-4">
                                    <label for="isi" class="form-label fw-bold">
                                        Isi Pengumuman
                                    </label>
                                    <textarea name="isi"
                                              id="isi"
                                              rows="6"
                                              class="form-control @error('isi') is-invalid @enderror"
                                              placeholder="Tuliskan isi lengkap pengumuman di sini..."
                                              required>{{ old('isi') }}</textarea>

                                    <small class="text-muted">
                                        Bisa berisi informasi detail, jadwal, ketentuan, dll.
                                    </small>

                                    @error('isi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                {{-- ================= FILE / GAMBAR ================= --}}
                                <div class="form-group mb-4">
                                    <label for="gambar" class="form-label fw-bold">
                                        Upload File / Gambar
                                    </label>
                                    <input type="file"
                                           name="gambar"
                                           id="gambar"
                                           class="form-control @error('gambar') is-invalid @enderror"
                                           accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx">

                                    <small class="text-muted">
                                        Format yang didukung: JPG, PNG, WEBP, PDF, DOC, DOCX.
                                    </small>

                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                {{-- ================= TANGGAL ================= --}}
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="tanggal_mulai" class="form-label fw-bold">
                                            Tanggal Mulai
                                        </label>
                                        <input type="date"
                                               name="tanggal_mulai"
                                               id="tanggal_mulai"
                                               class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                               value="{{ old('tanggal_mulai') }}"
                                               required>

                                        @error('tanggal_mulai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="tanggal_selesai" class="form-label fw-bold">
                                            Tanggal Selesai
                                        </label>
                                        <input type="date"
                                               name="tanggal_selesai"
                                               id="tanggal_selesai"
                                               class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                               value="{{ old('tanggal_selesai') }}">

                                        @error('tanggal_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                {{-- ================= STATUS ================= --}}
                                <hr>

                                <input type="hidden" name="urgent" value="0">
                                <div class="form-check form-switch mb-3">
                                    <input type="checkbox"
                                           name="urgent"
                                           value="1"
                                           class="form-check-input"
                                           {{ old('urgent') ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        Tandai sebagai Pengumuman Penting
                                    </label>
                                </div>

                                <input type="hidden" name="is_active" value="0">
                                <div class="form-check form-switch mb-4">
                                    <input type="checkbox"
                                           name="is_active"
                                           value="1"
                                           class="form-check-input"
                                           {{ old('is_active', 1) ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        Aktifkan Pengumuman
                                    </label>
                                </div>


                                {{-- ================= BUTTON ================= --}}
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary px-5">
                                        Simpan Pengumuman
                                    </button>

                                    <a href="{{ route('admin.pengumuman.index') }}"
                                       class="btn btn-secondary">
                                        Batal
                                    </a>
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
