<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('library/jqvmap/dist/jqvmap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('library/summernote/dist/summernote-bs4.min.css')); ?>">

<style>
.stat-card {
    border-radius: 18px;
    color: white;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.bg-gkm {
    background: linear-gradient(135deg, #6c95c2, #6366f1);
}

.bg-eif {
    background: linear-gradient(135deg, #eaa01f, #efc90e);
}

.bg-ss {
    background: linear-gradient(135deg, #0284c7, #38bdf8);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}

.icon-box {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    background: rgba(255,255,255,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
}

.stat-item {
    flex: 1;
    padding: 8px;
}

.stat-card h5,
.stat-card small,
.stat-card i {
    color: white !important;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
<section class="section">
<div class="section-header">
    <h1>Dashboard</h1>
</div>

<!-- ================= CARD ================= -->
<div class="row g-4">

<!-- GKM -->
<div class="col-md-4">
    <div class="card stat-card bg-gkm shadow-lg border-0">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <div class="icon-box"><i class="fas fa-users"></i></div>
                <div class="ms-3">
                    <h5 class="fw-bold mb-0">GKM</h5>
                </div>
            </div>

            <div class="d-flex text-center">
                <div class="stat-item"><h5><?php echo e($gkmUsers); ?></h5><small>Peserta</small></div>
                <div class="stat-item"><h5><?php echo e($gkmKarya); ?></h5><small>Judul</small></div>
                <div class="stat-item"><h5><?php echo e($gkmProposal); ?></h5><small>Makalah</small></div>
                <div class="stat-item"><h5><?php echo e($gkmFinal); ?></h5><small>Final</small></div>
            </div>
        </div>
    </div>
</div>

<!-- EIF -->
<div class="col-md-4">
    <div class="card stat-card bg-eif shadow-lg border-0">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <div class="icon-box"><i class="fas fa-user-graduate"></i></div>
                <div class="ms-3">
                    <h5 class="fw-bold mb-0">EIF</h5>
                </div>
            </div>

            <div class="d-flex text-center">
                <div class="stat-item"><h5><?php echo e($eifUsers); ?></h5><small>Peserta</small></div>
                <div class="stat-item"><h5><?php echo e($eifKarya); ?></h5><small>Judul</small></div>
                <div class="stat-item"><h5><?php echo e($eifProposal); ?></h5><small>Makalah</small></div>
                <div class="stat-item"><h5><?php echo e($eifFinal); ?></h5><small>Final</small></div>
            </div>
        </div>
    </div>
</div>

<!-- SS -->
<div class="col-md-4">
    <div class="card stat-card bg-ss shadow-lg border-0">
        <div class="card-body">
            <div class="d-flex align-items-center mb-4">
                <div class="icon-box"><i class="fas fa-lightbulb"></i></div>
                <div class="ms-3">
                    <h5 class="fw-bold mb-0">SS</h5>
                </div>
            </div>

            <div class="d-flex text-center">
                <div class="stat-item"><h5><?php echo e($ssUsers); ?></h5><small>Peserta</small></div>
                <div class="stat-item"><h5><?php echo e($ssKarya); ?></h5><small>Judul</small></div>
                <div class="stat-item"><h5><?php echo e($ssProposal); ?></h5><small>Makalah</small></div>
                <div class="stat-item"><h5><?php echo e($ssFinal); ?></h5><small>Final</small></div>
            </div>
        </div>
    </div>
</div>

</div>

<!-- ================= GRAFIK LAMA ================= -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card"><div class="card-body">
            <?php echo $judulChart->container(); ?>

        </div></div>
    </div>

    <div class="col-md-6">
        <div class="card"><div class="card-body">
            <?php echo $userTahapanChart->container(); ?>

        </div></div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card"><div class="card-body">
            <?php echo $proposalChart->container(); ?>

        </div></div>
    </div>

    <div class="col-md-6">
        <div class="card"><div class="card-body">
            <?php echo $finalChart->container(); ?>

        </div></div>
    </div>
</div>

<!-- ================= GRAFIK BARU ================= -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card"><div class="card-body">
            <h6>Perbandingan Peserta</h6>
            <div id="chartPeserta"></div>
        </div></div>
    </div>

    <div class="col-md-6">
        <div class="card"><div class="card-body">
            <h6>Proporsi Inovasi</h6>
            <div id="chartDonut"></div>
        </div></div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card"><div class="card-body">
            <h6>Tahapan Inovasi</h6>
            <div id="chartTahapan"></div>
        </div></div>
    </div>

    <div class="col-md-6">
        <div class="card"><div class="card-body">
            <h6>Final Terbaik</h6>
            <div id="chartFinal"></div>
        </div></div>
    </div>
</div>


</section>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- LARAPEX (LAMA) -->
<?php echo $judulChart->script(); ?>

<?php echo $proposalChart->script(); ?>

<?php echo $finalChart->script(); ?>

<?php echo $userTahapanChart->script(); ?>


<!-- APEX BARU -->
<script>
// Peserta
new ApexCharts(document.querySelector("#chartPeserta"), {
    chart: { type: 'bar', height: 300 },
    series: [{ data: [<?php echo e($gkmUsers); ?>, <?php echo e($eifUsers); ?>, <?php echo e($ssUsers); ?>] }],
    xaxis: { categories: ['GKM','EIF','SS'] },
    colors: ['#6366f1','#10b981','#38bdf8']
}).render();

// Donut
new ApexCharts(document.querySelector("#chartDonut"), {
    chart: { type: 'donut', height: 300 },
    series: [<?php echo e($gkmUsers); ?>, <?php echo e($eifUsers); ?>, <?php echo e($ssUsers); ?>],
    labels: ['GKM','EIF','SS'],
    colors: ['#6366f1','#10b981','#38bdf8']
}).render();

// Tahapan
new ApexCharts(document.querySelector("#chartTahapan"), {
    chart: { type: 'bar', stacked: true, height: 320 },
    series: [
        { name:'Judul', data:[<?php echo e($gkmKarya); ?>,<?php echo e($eifKarya); ?>,<?php echo e($ssKarya); ?>] },
        { name:'Makalah', data:[<?php echo e($gkmProposal); ?>,<?php echo e($eifProposal); ?>,<?php echo e($ssProposal); ?>] },
        { name:'Final', data:[<?php echo e($gkmFinal); ?>,<?php echo e($eifFinal); ?>,<?php echo e($ssFinal); ?>] }
    ],
    xaxis:{ categories:['GKM','EIF','SS'] },
    colors:['#f59e0b','#0ea5e9','#22c55e']
}).render();

// Final
new ApexCharts(document.querySelector("#chartFinal"), {
    chart: { type: 'bar', height: 300 },
    series: [{ data:[<?php echo e($gkmFinal); ?>,<?php echo e($eifFinal); ?>,<?php echo e($ssFinal); ?>] }],
    xaxis:{ categories:['GKM','EIF','SS'] },
    colors:['#22c55e']
}).render();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>