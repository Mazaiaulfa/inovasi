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
                            <h4 class="m-0">Edit Judul</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('karya.update', $karya->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        value="{{ old('judul', $karya->judul) }}" required>
                                    @error('judul')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                              <div class="mb-3">
    <label class="form-label">File Ajukan Saat Ini</label><br>

    @if ($karya->file_ajukan)
        <a href="{{ asset($karya->file_ajukan) }}"
           target="_blank"
           class="btn btn-sm btn-danger">
            Lihat PDF
        </a>
    @else
        <span class="text-muted">Tidak ada file</span>
    @endif
</div>

                            <div class="mb-3">
    <label for="file_ajukan" class="form-label">
        Ganti File Ajukan (PDF)
    </label>
    <input type="file"
           class="form-control"
           id="file_ajukan"
           name="file_ajukan"
           accept="application/pdf">

    <small class="text-muted">
        Kosongkan jika tidak ingin mengganti file
    </small>

    @error('file_ajukan')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-warning">Update</button>
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
