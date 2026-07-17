@extends('layouts.app')

@section('title', 'Dashboard Juri')

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
:root{
    --primary:#4f46e5;
    --secondary:#7c3aed;
    --success:#10b981;
    --warning:#f59e0b;
    --danger:#ef4444;
    --dark:#111827;
    --text:#6b7280;
    --bg:#f8fafc;
}

body{
    background:var(--bg);
}

/* ================= HEADER ================= */

.section-header{
    margin-bottom:18px;
}

.section-header h1{
    font-size:24px;
    font-weight:700;
    color:var(--dark);
}

/* ================= HERO ================= */

.hero-card{
    position:relative;
    overflow:hidden;
    border:none;
    border-radius:18px;
    background:linear-gradient(135deg,var(--primary),var(--secondary));
    color:#fff;
    padding:26px 30px;
    margin-bottom:22px;
    box-shadow:0 10px 25px rgba(79,70,229,.18);
}

.hero-card::before{
    content:'';
    position:absolute;
    width:200px;
    height:200px;
    border-radius:50%;
    background:rgba(255,255,255,.08);
    top:-90px;
    right:-70px;
}

.hero-card::after{
    content:'';
    position:absolute;
    width:140px;
    height:140px;
    border-radius:50%;
    background:rgba(255,255,255,.05);
    bottom:-60px;
    left:-30px;
}

.hero-content{
    position:relative;
    z-index:2;
}

.hero-title{
    font-size:25px;
    font-weight:700;
    margin-bottom:6px;
}

.hero-subtitle{
    font-size:14px;
    opacity:.9;
    margin-bottom:18px;
}

.progress-modern{
    height:8px;
    border-radius:50px;
    overflow:hidden;
    background:rgba(255,255,255,.2);
}

.progress-modern .bar{
    height:100%;
    background:#fff;
    border-radius:50px;
}

.hero-icon{
    font-size:72px;
    opacity:.12;
}

/* ================= STAT CARD ================= */

.stat-card{
    background:#fff;
    border:none;
    border-radius:18px;
    padding:20px;
    box-shadow:0 5px 18px rgba(0,0,0,.05);
    transition:.25s;
    height:100%;
}

.stat-card:hover{
    transform:translateY(-4px);
}

.stat-icon{
    width:55px;
    height:55px;
    border-radius:15px;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:20px;
    margin-bottom:14px;
}

.icon-blue{
    background:#eef2ff;
    color:#4f46e5;
}

.icon-green{
    background:#ecfdf5;
    color:#10b981;
}

.icon-orange{
    background:#fff7ed;
    color:#f59e0b;
}

.stat-title{
    font-size:13px;
    color:#6b7280;
    margin-bottom:4px;
}

.stat-number{
    font-size:28px;
    font-weight:700;
    color:#111827;
}

/* ================= CHART ================= */

.chart-card{
    border:none;
    border-radius:18px;
    background:#fff;
    overflow:hidden;
    box-shadow:0 5px 18px rgba(0,0,0,.05);
}

.chart-card .card-header{
    background:#fff;
    border:none;
    padding:18px 20px 0;
}

.chart-card .card-header h4{
    margin:0;
    font-size:16px;
    font-weight:700;
}

.chart-card .card-body{
    padding:15px 20px 20px;
}

#progressChart,
#nilaiChart{
    min-height:250px;
}

/* ================= RESPONSIVE ================= */

@media(max-width:768px){

.hero-card{
    padding:22px;
}

.hero-title{
    font-size:20px;
}

.hero-subtitle{
    font-size:13px;
}

.hero-icon{
    display:none;
}

.stat-number{
    font-size:24px;
}

.stat-card{
    padding:18px;
}

}
</style>
@endpush

@section('main')

<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Dashboard Juri</h1>
</div>

@php
$progress = $totalPeserta > 0
    ? round(($sudahDinilai / $totalPeserta) * 100)
    : 0;
@endphp

{{-- HERO --}}
<div class="hero-card">

    <div class="row align-items-center hero-content">

        <div class="col-lg-8">

            <div class="hero-title">
                👋 Selamat Datang, {{ auth()->user()->name }}
            </div>

            <div class="hero-subtitle">
                Kelola penilaian peserta dan pantau progres penjurian secara real-time.
            </div>

            <div class="mb-2">
                Progress Penilaian {{ $progress }}%
            </div>

            <div class="progress-modern">
                <div class="bar" style="width: {{ $progress }}%"></div>
            </div>

        </div>

        <div class="col-lg-4 text-right">
            <i class="fas fa-award hero-icon"></i>
        </div>

    </div>

</div>

{{-- STATISTIK --}}
<div class="row">

    <div class="col-lg-4 col-md-6 mb-4">
        <div class="stat-card">

            <div class="stat-icon icon-blue">
                <i class="fas fa-users"></i>
            </div>

            <div class="stat-title">
                Total Peserta
            </div>

            <div class="stat-number">
                {{ $totalPeserta }}
            </div>

        </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <div class="stat-card">

            <div class="stat-icon icon-green">
                <i class="fas fa-check-circle"></i>
            </div>

            <div class="stat-title">
                Sudah Dinilai
            </div>

            <div class="stat-number">
                {{ $sudahDinilai }}
            </div>

        </div>
    </div>

    <div class="col-lg-4 col-md-12 mb-4">
        <div class="stat-card">

            <div class="stat-icon icon-orange">
                <i class="fas fa-clock"></i>
            </div>

            <div class="stat-title">
                Belum Dinilai
            </div>

            <div class="stat-number">
                {{ $belumDinilai }}
            </div>

        </div>
    </div>

</div>

{{-- CHART --}}
<div class="row">

    <div class="col-lg-4 mb-4">

        <div class="chart-card">

            <div class="card-header">
                <h4>Progress Penilaian</h4>
            </div>

            <div class="card-body">
                <div id="progressChart"></div>
            </div>

        </div>

    </div>

    <div class="col-lg-8 mb-4">

        <div class="chart-card">

            <div class="card-header">
                <h4>Distribusi Nilai</h4>
            </div>

            <div class="card-body">
                <div id="nilaiChart"></div>
            </div>

        </div>

    </div>

</div>

</section>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>

let progress = {{ $progress }};

new ApexCharts(
document.querySelector("#progressChart"),
{
    chart:{
        height:320,
        type:'radialBar'
    },
    series:[progress],
    colors:['#4f46e5'],
    labels:['Selesai'],
    plotOptions:{
        radialBar:{
            hollow:{
                size:'68%'
            },
            track:{
                background:'#eef2ff'
            },
            dataLabels:{
                name:{
                    fontSize:'16px'
                },
                value:{
                    fontSize:'34px',
                    fontWeight:700
                }
            }
        }
    }
}).render();


new ApexCharts(
document.querySelector("#nilaiChart"),
{
    chart:{
        type:'bar',
        height:320,
        toolbar:{
            show:false
        }
    },

    series:[{
        name:'Jumlah Karya',
        data:[5,12,18]
    }],

    colors:['#4f46e5'],

    plotOptions:{
        bar:{
            borderRadius:12,
            columnWidth:'45%'
        }
    },

    dataLabels:{
        enabled:false
    },

    grid:{
        borderColor:'#f1f5f9'
    },

    xaxis:{
        categories:[
            '70-80',
            '81-90',
            '91-100'
        ]
    }
}
).render();

</script>
@endpush
