<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('library/jqvmap/dist/jqvmap.min.css')); ?>">

<style>
.stat-card{
    border-radius:20px;
    color:white;
    transition:.3s;
    overflow:hidden;
    border:none;
}

.stat-card:hover{
    transform:translateY(-5px);
    box-shadow:0 15px 30px rgba(0,0,0,.15);
}

.bg-gkm{
    background:linear-gradient(135deg,#6366f1,#8b5cf6);
}

.bg-eif{
    background:linear-gradient(135deg,#f59e0b,#f97316);
}

.bg-ss{
    background:linear-gradient(135deg,#0ea5e9,#06b6d4);
}

.icon-box{
    width:50px;
    height:50px;
    border-radius:14px;
    background:rgba(255,255,255,.15);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
}

.chart-card{
    border:none;
    border-radius:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.05);
}

.chart-title{
    font-weight:700;
    margin-bottom:15px;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Dashboard Inovasi</h1>
</div>

<!-- ================= CARD ================= -->

<div class="row">

    <!-- GKM -->
    <div class="col-md-4 mb-4">
        <div class="card stat-card bg-gkm">
            <div class="card-body">

                <div class="d-flex align-items-center mb-4">
                    <div class="icon-box">
                        <i class="fas fa-users"></i>
                    </div>

                    <div class="ml-3">
                        <h5 class="mb-0 text-white">GKM</h5>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-3">
                        <h4><?php echo e($gkmUsers); ?></h4>
                        <small>Peserta</small>
                    </div>

                    <div class="col-3">
                        <h4><?php echo e($gkmKarya); ?></h4>
                        <small>Judul</small>
                    </div>

                    <div class="col-3">
                        <h4><?php echo e($gkmProposal); ?></h4>
                        <small>Makalah</small>
                    </div>

                    <div class="col-3">
                        <h4><?php echo e($gkmFinal); ?></h4>
                        <small>Final</small>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- EIF -->
    <div class="col-md-4 mb-4">
        <div class="card stat-card bg-eif">
            <div class="card-body">

                <div class="d-flex align-items-center mb-4">
                    <div class="icon-box">
                        <i class="fas fa-lightbulb"></i>
                    </div>

                    <div class="ml-3">
                        <h5 class="mb-0 text-white">EIF</h5>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-3">
                        <h4><?php echo e($eifUsers); ?></h4>
                        <small>Peserta</small>
                    </div>

                    <div class="col-3">
                        <h4><?php echo e($eifKarya); ?></h4>
                        <small>Judul</small>
                    </div>

                    <div class="col-3">
                        <h4><?php echo e($eifProposal); ?></h4>
                        <small>Makalah</small>
                    </div>

                    <div class="col-3">
                        <h4><?php echo e($eifFinal); ?></h4>
                        <small>Final</small>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- SS -->
    <div class="col-md-4 mb-4">
        <div class="card stat-card bg-ss">
            <div class="card-body">

                <div class="d-flex align-items-center mb-4">
                    <div class="icon-box">
                        <i class="fas fa-award"></i>
                    </div>

                    <div class="ml-3">
                        <h5 class="mb-0 text-white">SS</h5>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-3">
                        <h4><?php echo e($ssUsers); ?></h4>
                        <small>Peserta</small>
                    </div>

                    <div class="col-3">
                        <h4><?php echo e($ssKarya); ?></h4>
                        <small>Judul</small>
                    </div>

                    <div class="col-3">
                        <h4><?php echo e($ssProposal); ?></h4>
                        <small>Makalah</small>
                    </div>

                    <div class="col-3">
                        <h4><?php echo e($ssFinal); ?></h4>
                        <small>Final</small>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<!-- ================= GRAFIK ================= -->

<div class="row">

    <!-- Tahapan -->
    <div class="col-md-6 mb-4">
        <div class="card chart-card">
            <div class="card-body">

                <h5 class="chart-title">
                    Tahapan Inovasi
                </h5>

                <?php echo $userTahapanChart->container(); ?>


            </div>
        </div>
    </div>

    <!-- Progress -->
    <div class="col-md-6 mb-4">
        <div class="card chart-card">
            <div class="card-body">

                <h5 class="chart-title">
                    Progress Inovasi
                </h5>

                <div id="chartProgress"></div>

            </div>
        </div>
    </div>

</div>

<div class="row">

    <!-- Trend -->
    <div class="col-md-6 mb-4">
        <div class="card chart-card">
            <div class="card-body">

                <h5 class="chart-title">
                    Trend Inovasi per Tahun
                </h5>

                <div id="chartTrend"></div>

            </div>
        </div>
    </div>

    <!-- Peserta -->
    <div class="col-md-6 mb-4">
        <div class="card chart-card">
            <div class="card-body">

                <h5 class="chart-title">
                    Partisipasi Peserta
                </h5>

                <div id="chartPeserta"></div>

            </div>
        </div>
    </div>

</div>

</section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- CHART LAMA -->
<?php echo $userTahapanChart->script(); ?>


<script>

//
// ================= PROGRESS
//
new ApexCharts(document.querySelector("#chartProgress"), {

    chart: {
        type: 'donut',
        height: 260
    },

    series: [
        <?php echo e($complete); ?>,
        <?php echo e($progress); ?>

    ],

    labels: [
        'Complete',
        'In Progress'
    ],

    colors: [
        '#22c55e',
        '#f59e0b'
    ]

}).render();


//
// ================= TREND
//
new ApexCharts(document.querySelector("#chartTrend"), {

    chart: {
        type: 'line',
        height: 320
    },

    series: [{
        name: 'Inovasi',
        data: <?php echo json_encode($trendData, 15, 512) ?>
    }],

    xaxis: {
        categories: <?php echo json_encode($trendYear, 15, 512) ?>
    },

    stroke: {
        curve: 'smooth',
        width: 4
    },

    colors: ['#6366f1']

}).render();


//
// ================= PESERTA
//
new ApexCharts(document.querySelector("#chartPeserta"), {

    chart: {
        type: 'bar',
        height: 320
    },

    series: [{
        name: 'Peserta',
        data: [
            <?php echo e($gkmUsers); ?>,
            <?php echo e($eifUsers); ?>,
            <?php echo e($ssUsers); ?>

        ]
    }],

    xaxis: {
        categories: ['GKM', 'EIF', 'SS']
    },

    colors: ['#06b6d4']

}).render();

</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>