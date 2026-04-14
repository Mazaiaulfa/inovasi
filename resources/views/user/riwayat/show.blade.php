@extends('layouts.app')

@section('title', 'Detail Pengajuan')

@push('style')
<style>
.timeline-wrapper {
    position: relative;
    margin-top: 40px;
}

.timeline-line {
    height: 4px;
    background: #e4e6ef;
    position: absolute;
    top: 12px;
    left: 0;
    right: 0;
    z-index: 1;
}

.timeline-progress {
    height: 4px;
    background: #6777ef;
    position: absolute;
    top: 12px;
    left: 0;
    z-index: 2;
}

.timeline-steps {
    display: flex;
    justify-content: space-between;
    position: relative;
    z-index: 3;
}

.step {
    text-align: center;
    width: 100%;
}

.circle {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #d1d5db;
    margin: auto;
}

.circle.active { background: #030a42; }
.circle.done { background: #28a745; }
.circle.reject { background: #dc3545; }

.step-label {
    margin-top: 10px;
    font-size: 13px;
    font-weight: 500;
}

.step-status {
    font-size: 12px;
    margin-top: 4px;
}
</style>
@endpush

@section('main')
<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Detail Pengajuan</h1>
</div>

<div class="section-body">
<div class="card">
<div class="card-body">

{{-- JUDUL --}}
<h5 class="mb-3">{{ $karya->judul }}</h5>
<hr>

{{-- INFO --}}
<div class="row mb-3">
    <div class="col-md-4">
        <strong>Tahun</strong><br>
        {{ $karya->created_at->format('Y') }}
    </div>

    <div class="col-md-4">
        <strong>Status</strong><br>
        @if($karya->status == 'publish')
            <span class="badge badge-success">Selesai</span>
        @else
            <span class="badge badge-warning">Dalam Proses</span>
        @endif
    </div>

    <div class="col-md-4">
        <strong>Tanggal Submit</strong><br>
        {{ $karya->created_at->format('d M Y') }}
    </div>
</div>

{{-- NILAI --}}
@if($karya->status == 'publish')
<div class="mb-3">
    <strong>Nilai Akhir</strong><br>
    <span class="badge badge-success">{{ $karya->nilai_akhir ?? '-' }}</span>
</div>
@endif

{{-- ================= TIMELINE ================= --}}
@php
$judul = $karya->status_judul ?? 'pending';
$proposal = $karya->status_proposal ?? 'pending';
$final = $karya->status_final ?? 'pending';
$penilaian = $karya->status_penilaian ?? 'pending';
$hasil = $karya->status == 'publish' ? 'selesai' : 'pending';

function warna($s){
    if($s=='diterima' || $s=='selesai') return 'done';
    if($s=='ditolak') return 'reject';
    if($s=='pending') return 'active';
}

$steps = [$judul,$proposal,$final,$penilaian,$hasil];
$current = 0;
foreach($steps as $i=>$s){
    if($s=='diterima' || $s=='selesai') $current = $i+1;
}
$percent = ($current/5)*100;
@endphp

<div class="timeline-wrapper">

    <div class="timeline-line"></div>
    <div class="timeline-progress" style="width: {{ $percent }}%"></div>

    <div class="timeline-steps">

        {{-- JUDUL --}}
        <div class="step">
            <div class="circle {{ warna($judul) }}"></div>
            <div class="step-label">Judul</div>
            <div class="step-status">
                {{ ucfirst($judul) }}
            </div>
        </div>

        {{-- PROPOSAL --}}
        <div class="step">
            <div class="circle {{ warna($proposal) }}"></div>
            <div class="step-label">Proposal</div>
            <div class="step-status">
                @if(!$karya->file_proposal)
                    Belum upload
                @else
                    {{ ucfirst($proposal) }}
                @endif
            </div>
        </div>

        {{-- FINAL --}}
        <div class="step">
            <div class="circle {{ warna($final) }}"></div>
            <div class="step-label">Finalisasi</div>
            <div class="step-status">
                @if(!$karya->file_final)
                    Belum upload
                @else
                    {{ ucfirst($final) }}
                @endif
            </div>
        </div>

        {{-- PENILAIAN --}}
        <div class="step">
            <div class="circle {{ warna($penilaian) }}"></div>
            <div class="step-label">Penilaian</div>
            <div class="step-status">
                @if($penilaian=='pending')
                    Belum dinilai
                @else
                    Sudah dinilai
                @endif
            </div>
        </div>

        {{-- HASIL --}}
        <div class="step">
            <div class="circle {{ warna($hasil) }}"></div>
            <div class="step-label">Hasil</div>
            <div class="step-status">
                @if($hasil=='pending')
                    Menunggu
                @else
                    Selesai
                @endif
            </div>
        </div>

    </div>
</div>

{{-- BUTTON --}}
<div class="mt-4">
    <a href="{{ route('riwayat.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
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

