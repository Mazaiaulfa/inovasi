@extends('layouts.app')

@section('title', 'Daftar Peserta')

@push('style')
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Daftar Peserta</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-body">

                    <table class="table table-bordered table-hover">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta</th>
                                <th>Email</th>
                                <th>Departemen</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($peserta as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->unit_kerja }}</td>
                                    <td>
                                        @if ($item->nilai)
                                            <span class="badge bg-primary">{{ $item->nilai }}</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Belum dinilai</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- Tombol NILAI --}}
                                        <a href="{{ route('juri.nilai.form', $item->id) }}"
                                           class="btn btn-success btn-sm"
                                           title="Beri Nilai">
                                            <i class="fas fa-star"></i> Nilai
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        Belum ada peserta yang di-assign
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>
            </div>

        </div>

    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endpush
