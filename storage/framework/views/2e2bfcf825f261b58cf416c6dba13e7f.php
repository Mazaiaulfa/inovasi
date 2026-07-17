<?php $__env->startSection('title', 'Dashboard Juri'); ?>

<?php $__env->startPush('style'); ?>
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

.section-header{
    margin-bottom:25px;
}

.section-header h1{
    font-size:28px;
    font-weight:700;
    color:var(--dark);
}

/* HERO */
.hero-card{
    position:relative;
    overflow:hidden;
    border:none;
    border-radius:24px;
    background:linear-gradient(135deg,var(--primary),var(--secondary));
    color:white;
    padding:35px;
    margin-bottom:25px;
    box-shadow:0 15px 35px rgba(79,70,229,.25);
}

.hero-card::before{
    content:'';
    position:absolute;
    width:250px;
    height:250px;
    border-radius:50%;
    background:rgba(255,255,255,.08);
    top:-100px;
    right:-80px;
}

.hero-card::after{
    content:'';
    position:absolute;
    width:180px;
    height:180px;
    border-radius:50%;
    background:rgba(255,255,255,.05);
    bottom:-80px;
    left:-50px;
}

.hero-content{
    position:relative;
    z-index:2;
}

.hero-title{
    font-size:30px;
    font-weight:700;
    margin-bottom:8px;
}

.hero-subtitle{
    opacity:.9;
    margin-bottom:20px;
}

.progress-modern{
    height:10px;
    border-radius:50px;
    background:rgba(255,255,255,.2);
    overflow:hidden;
}

.progress-modern .bar{
    height:100%;
    border-radius:50px;
    background:white;
}

.hero-icon{
    font-size:90px;
    opacity:.15;
}

/* STAT */
.stat-card{
    background:white;
    border:none;
    border-radius:22px;
    padding:25px;
    box-shadow:0 8px 25px rgba(0,0,0,.05);
    transition:.3s;
    height:100%;
}

.stat-card:hover{
    transform:translateY(-6px);
}

.stat-icon{
    width:65px;
    height:65px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
    margin-bottom:18px;
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
    color:#6b7280;
    font-size:14px;
    margin-bottom:6px;
}

.stat-number{
    font-size:34px;
    font-weight:700;
    color:#111827;
}

/* CHART */
.chart-card{
    border:none;
    border-radius:22px;
    background:white;
    box-shadow:0 8px 25px rgba(0,0,0,.05);
    overflow:hidden;
}

.chart-card .card-header{
    background:white;
    border:none;
    padding:25px 25px 0;
}

.chart-card .card-header h4{
    font-size:18px;
    font-weight:700;
    color:#111827;
    margin:0;
}

.chart-card .card-body{
    padding:20px 25px 25px;
}

#progressChart,
#nilaiChart{
    min-height:300px;
}

@media(max-width:768px){

    .hero-title{
        font-size:22px;
    }

    .hero-icon{
        display:none;
    }

    .stat-number{
        font-size:28px;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>

<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Dashboard Juri</h1>
</div>

<?php
$progress = $totalPeserta > 0
    ? round(($sudahDinilai / $totalPeserta) * 100)
    : 0;
?>


<div class="hero-card">

    <div class="row align-items-center hero-content">

        <div class="col-lg-8">

            <div class="hero-title">
                👋 Selamat Datang, <?php echo e(auth()->user()->name); ?>

            </div>

            <div class="hero-subtitle">
                Kelola penilaian peserta dan pantau progres penjurian secara real-time.
            </div>

            <div class="mb-2">
                Progress Penilaian <?php echo e($progress); ?>%
            </div>

            <div class="progress-modern">
                <div class="bar" style="width: <?php echo e($progress); ?>%"></div>
            </div>

        </div>

        <div class="col-lg-4 text-right">
            <i class="fas fa-award hero-icon"></i>
        </div>

    </div>

</div>


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
                <?php echo e($totalPeserta); ?>

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
                <?php echo e($sudahDinilai); ?>

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
                <?php echo e($belumDinilai); ?>

            </div>

        </div>
    </div>

</div>


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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>

let progress = <?php echo e($progress); ?>;

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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/juri/dashboard.blade.php ENDPATH**/ ?>