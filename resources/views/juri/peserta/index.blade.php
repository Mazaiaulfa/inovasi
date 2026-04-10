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

                    {{-- HITUNG --}}
                    @php
                        $belumDinilai = $peserta->where('nilai', null)->count();
                        $totalPeserta = $peserta->count();
                        $sudahDinilai = $totalPeserta - $belumDinilai;
                    @endphp

                    {{-- INFO --}}
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            Progress Penilaian:
                            <span class="badge bg-primary">
                                {{ $sudahDinilai }}/{{ $totalPeserta }}
                            </span>

                            | Belum Dinilai:
                            <span class="badge bg-danger">
                                {{ $belumDinilai }}
                            </span>
                        </h6>
                    </div>

                    {{-- TABLE --}}
                    <table class="table table-bordered table-hover">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta</th>
                                <th>Email</th>
                                <th>Departemen</th>
                                <th>Nilai</th>
                                <th>Status</th>
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

                                    {{-- NILAI --}}
                                    <td>
                                        @if ($item->nilai)
                                            <span class="badge bg-primary">
                                                {{ $item->nilai }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark">
                                                Belum dinilai
                                            </span>
                                        @endif
                                    </td>

                                    {{-- STATUS --}}
                                    <td>
                                        @if ($item->status == 'draft')
                                            <span class="badge bg-warning text-dark">Draft</span>
                                        @elseif ($item->status == 'submitted')
                                            <span class="badge bg-success">Submitted</span>
                                        @else
                                            <span class="badge bg-secondary">-</span>
                                        @endif
                                    </td>

                                    {{-- AKSI --}}
                                    <td>
    @if ($item->status == 'draft')

        <a href="{{ route('juri.nilai.form', $item->id) }}"
           class="btn btn-sm {{ $item->nilai ? 'btn-warning' : 'btn-success' }}">

            <i class="fas {{ $item->nilai ? 'fa-edit' : 'fa-star' }}"></i>

            {{ $item->nilai ? 'Edit' : 'Nilai' }}

        </a>

    @else
        <span class="badge bg-secondary">
            Terkunci
        </span>
    @endif
</td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Belum ada peserta yang di-assign
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- SUBMIT SEMUA --}}
                    <div class="mt-4 text-end">

                        <form action="{{ route('juri.submit.semua') }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="btn btn-primary"
                                {{ $belumDinilai > 0 ? 'disabled' : '' }}
                                onclick="return confirm('Submit semua penilaian? Tidak bisa diedit lagi!')">

                                <i class="fas fa-paper-plane"></i>
                                Submit Permanen Semua

                            </button>

                        </form>

                    </div>

                </div>
            </div>

        </div>

    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endpush
