@extends('layouts.app')
@section('title', 'Verifikasi Judul')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
@endpush
@section('content')
<div class="container mx-auto py-6">

    <h1 class="text-2xl font-bold mb-6">Edit Pengumuman</h1>

    <a href="{{ route('admin.pengumuman.index') }}" class="text-blue-600 mb-4 inline-block">&larr; Kembali</a>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pengumuman.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow p-6 rounded-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Ringkasan</label>
            <textarea name="ringkasan" rows="2" class="w-full border rounded px-3 py-2">{{ old('ringkasan', $pengumuman->ringkasan) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Isi Pengumuman</label>
            <textarea name="isi" rows="6" class="w-full border rounded px-3 py-2">{{ old('isi', $pengumuman->isi) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Gambar</label>
            @if($pengumuman->gambar)
                <div class="mb-2">
                    <img src="{{ asset($pengumuman->gambar) }}" alt="Gambar" class="w-48 rounded shadow">
                </div>
            @endif
            <input type="file" name="gambar" accept="image/*" class="w-full">
            <small class="text-gray-500">Kosongkan jika tidak ingin mengganti gambar</small>
        </div>

        <div class="mb-4 flex gap-4">
            <div>
                <label class="block font-semibold mb-1">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $pengumuman->tanggal_mulai) }}" class="border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $pengumuman->tanggal_selesai) }}" class="border rounded px-3 py-2">
            </div>
        </div>

        <div class="mb-4 flex items-center gap-2">
            <input type="checkbox" name="urgent" value="1" id="urgent" {{ $pengumuman->urgent ? 'checked' : '' }}>
            <label for="urgent" class="font-semibold">Tandai sebagai Pengumuman Penting (Urgent)</label>
        </div>

        <div class="mb-4 flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" id="is_active" {{ $pengumuman->is_active ? 'checked' : '' }}>
            <label for="is_active" class="font-semibold">Aktifkan Pengumuman</label>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Update Pengumuman
        </button>
    </form>
</div>
@endsection
