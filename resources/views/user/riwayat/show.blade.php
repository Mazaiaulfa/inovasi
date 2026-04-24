@extends('layouts.app')

@section('title', 'Detail Pengajuan')

@push('style')
<style>
.timeline-wrapper {
    position: relative;
    margin-top: 40px;
    padding: 20px 10px;
}

.timeline-line {
    height: 3px;
    background: #e5e7eb;
    position: absolute;
    top: 22px;
    left: 0;
    right: 0;
    z-index: 1;
    border-radius: 10px;
}

.timeline-progress {
    height: 3px;
    background: #2563eb;
    position: absolute;
    top: 22px;
    left: 0;
    z-index: 2;
    border-radius: 10px;
    transition: 0.4s;
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
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: #d1d5db;
    border: 4px solid #fff;
    box-shadow: 0 0 0 2px #e5e7eb;
    margin: auto;
}

.circle.active {
    background: #2563eb;
    box-shadow: 0 0 0 3px #93c5fd;
}

.circle.done {
    background: #2563eb;
}

.step-label {
    margin-top: 10px;
    font-size: 13px;
    font-weight: 500;
    color: #6b7280;
}

.step.active .step-label {
    color: #111827;
    font-weight: 600;
}

.step-status {
    font-size: 11px;
    margin-top: 6px;
}

.badge-status {
    background: #fef3c7;
    color: #92400e;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 11px;
}

.table-sm td, .table-sm th {
    padding: 6px;
    font-size: 12px;
}

.card.border {
    border: 1px solid #e5e7eb !important;
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

{{-- <h5 class="mb-3">{{ $karya->judul }}</h5>
<hr> --}}

 @php
$hasil = $karya->hasilAkhir;

if(!$hasil){
    $statusText = 'Belum dinilai';
}
elseif($hasil->is_complete == 0){
    $statusText = 'Sedang dinilai';
}
elseif($hasil->is_complete == 1 && $hasil->is_published == 0){
    $statusText = 'Menunggu publish';
}
else{
    $statusText = 'Selesai';
}

$judul = 'diterima';
$proposal = $karya->proposals->isNotEmpty() ? 'diterima' : 'pending';
$final = $karya->finalKarya ? 'diterima' : 'pending';

if(!$hasil || $hasil->is_complete == 0){
    $penilaian = 'pending';
} else {
    $penilaian = 'diterima';
}

$hasilStep = ($hasil && $hasil->is_published) ? 'selesai' : 'pending';

function warna($s){
    if($s=='diterima' || $s=='selesai') return 'done';
    return 'active';
}

$steps = [$judul,$proposal,$final,$penilaian,$hasilStep];
$current = 0;

foreach($steps as $i=>$s){
    if($s=='diterima' || $s=='selesai'){
        $current = $i+1;
    }
}

$currentIndex = $current - 1;
$percent = ($current/5)*100;
@endphp

{{-- INFO --}}
{{-- <div class="row mb-3">
    <div class="col-md-4">
        <strong>Tahun</strong><br>
        {{ $karya->created_at->format('Y') }}
    </div>

    <div class="col-md-4">
        <strong>Status</strong><br>
        <span class="badge bg-primary">{{ $statusText }}</span>
    </div>

    <div class="col-md-4">
        <strong>Tanggal Submit</strong><br>
        {{ $karya->created_at->format('d M Y') }}
    </div>
</div> --}}

{{-- NILAI --}}
{{-- @if($hasil && $hasil->is_published)
<div class="mb-3">
    <strong>Nilai Akhir</strong><br>
    <span class="badge bg-success">
        {{ round($hasil->rata_nilai,2) }}
    </span>
</div>
@endif

{{-- TIMELINE --}}
{{-- <div class="timeline-wrapper">
    <div class="timeline-line"></div>
    <div class="timeline-progress" style="width: {{ $percent }}%"></div>

    <div class="timeline-steps">

        @php $labels = ['Judul','Proposal','Finalisasi','Penilaian','Hasil']; @endphp

        @foreach($labels as $i => $label)
        <div class="step {{ $currentIndex == $i ? 'active' : '' }}">
            <div class="circle {{ warna($steps[$i]) }}"></div>
            <div class="step-label">{{ $label }}</div>
        </div>
        @endforeach

    </div>
</div> --}}

{{-- ================= TAMBAHAN UI ================= --}}

{{-- APRESIASI --}}
@if($hasil && $hasil->is_published)
<div class="mt-4">
    <h6 class="mb-3">
        <i class="bi bi-trophy me-2 text-warning"></i>
        Hasil & Apresiasi
    </h6>

    <div class="card border shadow-sm">
        <div class="card-body text-center">

                    <h4 class="mb-2" style="color:#b45309">
                <i class="bi bi-trophy-fill me-2"></i>
                Apresiasi Karya
            </h4>

            <div class="mb-2">
                <span class="badge bg-warning text-dark">
                    <i class="bi bi-award me-1"></i>
                    {{ $hasil->apresiasi ?? 'Peserta' }}
                </span>
            </div>

            <p class="text-muted mb-0">
                Hasil penilaian telah dipublikasikan.
            </p>

        </div>
    </div>
</div>
@endif
{{-- PENILAIAN --}}
<div class="mt-4">
    <h6 class="mb-3">
        <i class="bi bi-bar-chart-line me-2 text-primary"></i>
        Ringkasan Penilaian
    </h6>

    <div class="row g-3">

        {{-- TOTAL JURI --}}
        <div class="col-md-4">
            <div class="card border text-center h-100 shadow-sm">
                <div class="card-body">
                    <i class="bi bi-people text-secondary mb-2" style="font-size:20px;"></i>
                    <div><small class="text-muted">Total Juri</small></div>
                    <h4 class="mb-0 mt-1">
                        {{ $hasil->total_juri ?? 0 }}
                    </h4>
                </div>
            </div>
        </div>

        {{-- SUDAH MENILAI --}}
        <div class="col-md-4">
            <div class="card border text-center h-100 shadow-sm">
                <div class="card-body">
                    <i class="bi bi-check-circle text-success mb-2" style="font-size:20px;"></i>
                    <div><small class="text-muted">Sudah Menilai</small></div>
                    <h4 class="mb-0 mt-1">
                        {{ $hasil->jumlah_juri ?? 0 }}
                    </h4>
                </div>
            </div>
        </div>

        {{-- NILAI --}}
        <div class="col-md-4">
            <div class="card border text-center h-100 shadow-sm">
                <div class="card-body">
                    <i class="bi bi-star-fill text-warning mb-2" style="font-size:20px;"></i>
                    <div><small class="text-muted">Nilai Rata-rata</small></div>
                    <h4 class="mb-0 mt-1 text-primary">
                        {{ $hasil ? round($hasil->rata_nilai,2) : '-' }}
                    </h4>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="mt-4">
    <a href="{{ route('riwayat.index') }}" class="btn btn-secondary">
        <i class="bi bi-box-arrow-in-left"></i>
    </a>
</div>

</div>
</div>
</div>

</section>
</div>
@endsection
