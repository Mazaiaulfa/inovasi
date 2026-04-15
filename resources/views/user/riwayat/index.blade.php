@extends('layouts.app')

@section('title', 'Riwayat Pengajuan')

@push('style')
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Riwayat Pengajuan</h1>
        </div>

        <div class="section-body">

            <div class="card">

                <div class="card-body">

                <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Karya</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($karyas as $index => $karya)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $karya->judul }}</td>
                            <td>{{ $karya->created_at->format('Y') }}</td>

                            {{-- STATUS --}}
                            <td>
   @php
    $penilaian = $karya->penilaian->last();
@endphp

@if(optional($penilaian)->status == 'submitted')
    <span class="badge bg-info">Terkirim</span>
@elseif(optional($penilaian)->status == 'dinilai')
    <span class="badge bg-warning">Dinilai</span>
@elseif(optional($penilaian)->status == 'publish')
    <span class="badge bg-success">Selesai</span>
@else
    <span class="badge bg-secondary">Belum dinilai</span>
@endif
</td>

                            {{-- ACTION --}}
                            <td class="text-center">
                                <a href="{{ route('riwayat.show', $karya->id) }}"
                                   class="btn btn-outline-dark btn-sm">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada pengajuan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endpush
