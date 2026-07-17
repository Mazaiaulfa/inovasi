@extends('layouts.app')

@section('title', 'Detail Pengajuan')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
:root{
    --primary:#6366f1;
    --primary-soft:#eef2ff;
    --success:#10b981;
    --warning:#f59e0b;
    --border:#e5e7eb;
    --muted:#64748b;
}

body{
    background:#f8fafc;
}

.section-header{
    margin-bottom:20px;
}

.section-header h1{
    font-size:1.6rem;
    font-weight:700;
    color:#111827;
}

.main-card{
    border:1px solid var(--border);
    border-radius:18px;
    overflow:hidden;
    background:#fff;
    box-shadow:
        0 1px 2px rgba(15,23,42,.04),
        0 10px 25px rgba(15,23,42,.04);
}

.hero-header{
    background:#fff;
    border-bottom:1px solid var(--border);
    padding:24px 28px;
}

.hero-title{
    font-size:22px;
    font-weight:700;
    color:#111827;
    margin-bottom:4px;
    line-height:1.4;
}

.hero-subtitle{
    color:var(--muted);
    font-size:13px;
}

.status-badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    background:#f8fafc;
    color:#334155;
    border:1px solid var(--border);
    padding:8px 14px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}

.info-box{
    background:#fff;
    border:1px solid var(--border);
    border-radius:16px;
    padding:18px 20px;
}

.info-box small{
    color:#94a3b8;
    font-size:12px;
    margin-bottom:4px;
}

.info-box strong{
    color:#111827;
    font-weight:600;
}

.section-title{
    font-size:15px;
    font-weight:700;
    color:#111827;
    margin-bottom:14px;
    display:flex;
    align-items:center;
    gap:8px;
}

.stat-card{
    border:1px solid var(--border);
    border-radius:16px;
    background:#fff;
    box-shadow:none;
    transition:.2s ease;
}

.stat-card:hover{
    transform:translateY(-2px);
    border-color:#cbd5e1;
}

.stat-card .card-body{
    padding:22px;
}

.icon-box{
    width:42px;
    height:42px;
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto;
    font-size:16px;
}

.icon-primary{
    background:#eef2ff;
    color:#6366f1;
}

.icon-success{
    background:#ecfdf5;
    color:#10b981;
}

.icon-warning{
    background:#fffbeb;
    color:#f59e0b;
}

.stat-value{
    font-size:24px;
    font-weight:700;
    line-height:1.2;
    margin-top:6px;
    color:#111827;
}

.score-highlight{
    color:#6366f1;
}

.apresiasi-card{
    border:1px solid #fde68a;
    border-radius:16px;
    background:#fffbeb;
    box-shadow:none;
}

.apresiasi-icon{
    font-size:32px;
    color:#f59e0b;
}

.apresiasi-title{
    font-size:18px;
    font-weight:700;
    color:#92400e;
}

.apresiasi-card p{
    font-size:13px;
}

.btn-back{
    background:#fff;
    color:#334155;
    border:1px solid var(--border);
    border-radius:12px;
    padding:10px 16px;
    font-weight:600;
    transition:.2s;
}

.btn-back:hover{
    background:#f8fafc;
    color:#111827;
    text-decoration:none;
}

.card{
    overflow:hidden;
}

@media (max-width:768px){

    .hero-header{
        padding:20px;
    }

    .hero-title{
        font-size:18px;
    }

    .stat-value{
        font-size:20px;
    }

    .info-box{
        padding:16px;
    }
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

@php
$hasil = $karya->hasilAkhir;

if(!$hasil){
    $statusText = 'Belum Dinilai';
}
elseif($hasil->is_complete == 0){
    $statusText = 'Sedang Dinilai';
}
elseif($hasil->is_complete == 1 && $hasil->is_published == 0){
    $statusText = 'Menunggu Publikasi';
}
else{
    $statusText = 'Selesai';
}
@endphp

<div class="card main-card">
    <div class="card-body p-0">

        {{-- HERO HEADER --}}
        <div class="hero-header">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>
                    <div class="hero-title">
                        {{ $karya->judul }}
                    </div>

                    <div class="hero-subtitle">
                        Detail pengajuan karya inovasi peserta
                    </div>
                </div>

                <div class="mt-3 mt-md-0">
                    <span class="status-badge">
                        <i class="bi bi-info-circle me-1"></i>
                        {{ $statusText }}
                    </span>
                </div>

            </div>

        </div>

        <div class="p-4">

            {{-- INFO --}}
            <div class="info-box mb-4">

                <div class="row">

                    <div class="col-md-4 mb-3 mb-md-0">
                        <small class="text-muted d-block">
                            Tahun Pengajuan
                        </small>
                        <strong>
                            {{ $karya->created_at->format('Y') }}
                        </strong>
                    </div>

                    <div class="col-md-4 mb-3 mb-md-0">
                        <small class="text-muted d-block">
                            Tanggal Submit
                        </small>
                        <strong>
                            {{ $karya->created_at->format('d M Y') }}
                        </strong>
                    </div>

                    <div class="col-md-4">
                        <small class="text-muted d-block">
                            Status
                        </small>
                        <strong>
                            {{ $statusText }}
                        </strong>
                    </div>

                </div>

            </div>

            {{-- APRESIASI --}}
            @if($hasil && $hasil->is_published)
            <div class="mb-4">
                    <i class="bi bi-trophy-fill text-warning me-2"></i>
                    Hasil & Apresiasi
                </div>

                <div class="card apresiasi-card">
                    <div class="card-body text-center py-4">

                        <div class="apresiasi-icon">
                            <i class="bi bi-trophy-fill"></i>
                        </div>

                        <div class="apresiasi-title mt-2">
                            {{ $hasil->apresiasi ?? 'Peserta' }}
                        </div>

                        <p class="text-muted mb-0 mt-2">
                            Hasil penilaian telah dipublikasikan.
                        </p>

                    </div>
                </div>

            </div>
            @endif

            {{-- PENILAIAN --}}
            <div>

                    <i class="bi bi-bar-chart-fill text-primary me-2"></i>
                    Ringkasan Penilaian
                </div>

                <div class="row g-4">

                    <div class="col-md-4">
                        <div class="card stat-card h-100">
                            <div class="card-body text-center">

                                <div class="icon-box icon-primary">
                                    <i class="bi bi-people-fill"></i>
                                </div>

                                <div class="mt-3 text-muted">
                                    Total Juri
                                </div>

                                <div class="stat-value">
                                    {{ $hasil->total_juri ?? 0 }}
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card stat-card h-100">
                            <div class="card-body text-center">

                                <div class="icon-box icon-success">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>

                                <div class="mt-3 text-muted">
                                    Sudah Menilai
                                </div>

                                <div class="stat-value">
                                    {{ $hasil->jumlah_juri ?? 0 }}
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card stat-card h-100">
                            <div class="card-body text-center">

                                <div class="icon-box icon-warning">
                                    <i class="bi bi-star-fill"></i>
                                </div>

                                <div class="mt-3 text-muted">
                                    Nilai Rata-rata
                                </div>

                                <div class="stat-value score-highlight">
                                    {{ $hasil ? round($hasil->rata_nilai,2) : '-' }}
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="mt-5">

                <a href="{{ route('riwayat.index') }}" class="btn btn-back">
                    <i class="bi bi-arrow-left me-2"></i>
                    Kembali ke Riwayat
                </a>

            </div>

        </div>

    </div>
</div>

</div>

</section>
</div>
@endsection
