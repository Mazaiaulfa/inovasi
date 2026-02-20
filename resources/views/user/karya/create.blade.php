@extends('layouts.app')
@section('title', 'Pengajuan Judul')

@section('main')
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Judul</h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('karya.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        value="{{ old('judul') }}" required>
                                    @error('judul')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                <label for="file_ajukan" class="form-label">
                                    File Ajukan (PDF)
                                </label>
                                <input type="file"
                                    class="form-control"
                                    id="file_ajukan"
                                    name="file_ajukan"
                                    accept="application/pdf"
                                    required>

                                <small class="text-muted">
                                    Upload file PDF (maks. 2MB) dengan format "Nama Team.pdf"
                                </small>

                                @error('file_ajukan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Ajukan</button>
                                    <a href="{{ route('karya.index') }}" class="btn btn-secondary">Batal</a>
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
