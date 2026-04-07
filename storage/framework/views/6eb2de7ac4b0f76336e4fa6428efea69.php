<?php $__env->startSection('title', 'Daftar Gugus Juri'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header">
                <h5>Gugus yang Dinilai: <?php echo e($juri->name); ?></h5>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Gugus</th>
                            <th>Email</th>
                            <th>Departemen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $peserta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($p->name); ?></td>
                            <td><?php echo e($p->email); ?></td>
                            <td><?php echo e($p->unit_kerja ?? '-'); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center">Belum ada gugus</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <a href="<?php echo e(route('admin.juri.index')); ?>" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/juri/daftar.blade.php ENDPATH**/ ?>