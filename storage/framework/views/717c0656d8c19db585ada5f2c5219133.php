<?php $__env->startSection('title', 'Detail Pengajuan'); ?>

<?php $__env->startPush('style'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Detail Pengajuan</h1>
</div>

<div class="section-body">
<div class="card">
<div class="card-body">


<h5 class="mb-3"><?php echo e($karya->judul); ?></h5>
<hr>


<div class="row mb-3">
    <div class="col-md-4">
        <strong>Tahun</strong><br>
        <?php echo e($karya->created_at->format('Y')); ?>

    </div>

    <div class="col-md-4">
        <strong>Status</strong><br>
        <?php if($karya->status == 'publish'): ?>
            <span class="badge badge-success">Selesai</span>
        <?php else: ?>
            <span class="badge badge-warning">Dalam Proses</span>
        <?php endif; ?>
    </div>

    <div class="col-md-4">
        <strong>Tanggal Submit</strong><br>
        <?php echo e($karya->created_at->format('d M Y')); ?>

    </div>
</div>


<?php if($karya->status == 'publish'): ?>
<div class="mb-3">
    <strong>Nilai Akhir</strong><br>
    <span class="badge badge-success"><?php echo e($karya->nilai_akhir ?? '-'); ?></span>
</div>
<?php endif; ?>


<?php
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
?>

<div class="timeline-wrapper">

    <div class="timeline-line"></div>
    <div class="timeline-progress" style="width: <?php echo e($percent); ?>%"></div>

    <div class="timeline-steps">

        
        <div class="step">
            <div class="circle <?php echo e(warna($judul)); ?>"></div>
            <div class="step-label">Judul</div>
            <div class="step-status">
                <?php echo e(ucfirst($judul)); ?>

            </div>
        </div>

        
        <div class="step">
            <div class="circle <?php echo e(warna($proposal)); ?>"></div>
            <div class="step-label">Proposal</div>
            <div class="step-status">
                <?php if(!$karya->file_proposal): ?>
                    Belum upload
                <?php else: ?>
                    <?php echo e(ucfirst($proposal)); ?>

                <?php endif; ?>
            </div>
        </div>

        
        <div class="step">
            <div class="circle <?php echo e(warna($final)); ?>"></div>
            <div class="step-label">Finalisasi</div>
            <div class="step-status">
                <?php if(!$karya->file_final): ?>
                    Belum upload
                <?php else: ?>
                    <?php echo e(ucfirst($final)); ?>

                <?php endif; ?>
            </div>
        </div>

        
        <div class="step">
            <div class="circle <?php echo e(warna($penilaian)); ?>"></div>
            <div class="step-label">Penilaian</div>
            <div class="step-status">
                <?php if($penilaian=='pending'): ?>
                    Belum dinilai
                <?php else: ?>
                    Sudah dinilai
                <?php endif; ?>
            </div>
        </div>

        
        <div class="step">
            <div class="circle <?php echo e(warna($hasil)); ?>"></div>
            <div class="step-label">Hasil</div>
            <div class="step-status">
                <?php if($hasil=='pending'): ?>
                    Menunggu
                <?php else: ?>
                    Selesai
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>


<div class="mt-4">
    <a href="<?php echo e(route('riwayat.index')); ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

</div>
</div>
</div>
</section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/user/riwayat/show.blade.php ENDPATH**/ ?>