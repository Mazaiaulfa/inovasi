<?php $__env->startSection('title', 'Riwayat Pengajuan'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Riwayat Pengajuan</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul Karya</th>
                                    <th width="15%">Tahun</th>
                                    <th width="20%">Status</th>
                                    <th width="15%" class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $karyas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $karya): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $hasil = $karya->hasilAkhir;

                                    if (!$hasil) {
                                        $status = ['text' => 'Belum dinilai', 'class' => 'text-secondary'];
                                    } elseif ($hasil->is_complete == 0) {
                                        $status = ['text' => 'Sedang Dinilai', 'class' => 'text-info'];
                                    } elseif ($hasil->is_complete == 1 && $hasil->is_published == 0) {
                                        $status = ['text' => 'Menunggu Publish', 'class' => 'text-warning'];
                                    } else {
                                        $status = ['text' => 'Selesai', 'class' => 'text-success'];
                                    }
                                ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>

                                    <td>
                                        <?php echo e($karya->judul); ?>

                                    </td>

                                    <td><?php echo e($karya->created_at->format('Y')); ?></td>

                                    <td>
                                        <span class="<?php echo e($status['class']); ?>">
                                            <?php echo e($status['text']); ?>

                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <a href="<?php echo e(route('riwayat.show', $karya->id)); ?>"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                        Belum ada pengajuan
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/user/riwayat/index.blade.php ENDPATH**/ ?>