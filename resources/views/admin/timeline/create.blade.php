@extends('layouts.app')
@section('title', 'Tambah Pengumuman')

@section('main')

@section('main')
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>Tambah Timeline</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.timeline.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" class="form-control"
                                   value="{{ old('urutan') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul / Tahap</label>
                            <input type="text" name="judul" class="form-control"
                                   value="{{ old('judul') }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai"
                                       class="form-control"
                                       value="{{ old('tanggal_mulai') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai"
                                       class="form-control"
                                       value="{{ old('tanggal_selesai') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" rows="4"
                                      class="form-control">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.pengumuman.index') }}"
                               class="btn btn-secondary">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
