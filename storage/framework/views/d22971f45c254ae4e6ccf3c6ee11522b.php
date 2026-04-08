<?php $__env->startSection('title', 'Daftar Peserta'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('library/jqvmap/dist/jqvmap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('library/summernote/dist/summernote-bs4.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Daftar Peserta</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-body">

                    <table class="table table-bordered table-hover">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta</th>
                                <th>Email</th>
                                <th>Departemen</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $peserta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td><?php echo e($item->email); ?></td>
                                    <td><?php echo e($item->unit_kerja); ?></td>
                                    <td>
                                        <?php if($item->nilai): ?>
                                            <span class="badge bg-primary"><?php echo e($item->nilai); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Belum dinilai</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        
                                        <a href="<?php echo e(route('juri.nilai.form', $item->id)); ?>"
                                           class="btn btn-success btn-sm"
                                           title="Beri Nilai">
                                            <i class="fas fa-star"></i> Nilai
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        Belum ada peserta yang di-assign
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>

                </div>
            </div>

        </div>

    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/juri/peserta/index.blade.php ENDPATH**/ ?>