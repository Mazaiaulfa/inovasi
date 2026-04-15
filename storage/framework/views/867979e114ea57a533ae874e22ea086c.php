<?php $__env->startSection('title', 'Riwayat Pengajuan'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('library/jqvmap/dist/jqvmap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('library/summernote/dist/summernote-bs4.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Riwayat Pengajuan</h1>
        </div>

        <div class="section-body">

            <div class="card">

                <div class="card-body">

                <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Karya</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $karyas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $karya): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($karya->judul); ?></td>
                            <td><?php echo e($karya->created_at->format('Y')); ?></td>

                            
                            <td>
   <?php
    $penilaian = $karya->penilaian->last();
?>

<?php if(optional($penilaian)->status == 'submitted'): ?>
    <span class="badge bg-info">Terkirim</span>
<?php elseif(optional($penilaian)->status == 'dinilai'): ?>
    <span class="badge bg-warning">Dinilai</span>
<?php elseif(optional($penilaian)->status == 'publish'): ?>
    <span class="badge bg-success">Selesai</span>
<?php else: ?>
    <span class="badge bg-secondary">Belum dinilai</span>
<?php endif; ?>
</td>

                            
                            <td class="text-center">
                                <a href="<?php echo e(route('riwayat.show', $karya->id)); ?>"
                                   class="btn btn-outline-dark btn-sm">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada pengajuan</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/user/riwayat/index.blade.php ENDPATH**/ ?>