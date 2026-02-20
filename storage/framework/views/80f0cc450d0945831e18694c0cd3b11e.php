<?php $__env->startSection('title', 'Kelola Pengumuman'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    /* Flex container untuk search + filter */
    .dataTables_wrapper .dataTables_filter {
        display: flex !important;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        flex-direction: row-reverse;
    }

    .dataTables_wrapper .dataTables_filter label {
        margin: 0;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .dataTables_wrapper .dataTables_filter select {
        height: calc(1.5em + .75rem + 2px);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Kelola Pengumuman</h4>
                            <a href="<?php echo e(route('admin.pengumuman.create')); ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Pengumuman
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                              <table id="pengumumanTable" class="table table-striped table-bordered table-hover w-100">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Ringkasan</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Urgent</th>
            <th>Status</th> <!-- is_active -->
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $pengumumans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($item->judul); ?></td>
            <td><?php echo e(Str::limit($item->ringkasan, 50)); ?></td>
            <td><?php echo e($item->tanggal_mulai); ?></td>
            <td><?php echo e($item->tanggal_selesai ?? '-'); ?></td>
            <td>
                <?php if($item->urgent): ?>
                    <span class="badge bg-danger">PENTING</span>
                <?php else: ?>
                    <span class="badge bg-secondary">Normal</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if($item->is_active): ?>
                    <span class="badge bg-success">Aktif</span>
                <?php else: ?>
                    <span class="badge bg-secondary">Nonaktif</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if($item->gambar): ?>
                    <img src="<?php echo e(asset($item->gambar)); ?>" alt="Gambar" class="img-thumbnail" style="width:100px;">
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
            <td class="d-flex gap-2">
                <a href="<?php echo e(route('admin.pengumuman.edit', $item->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                <form action="<?php echo e(route('admin.pengumuman.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

                                
                                <div class="mt-3">
                                    <?php echo e($pengumumans->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script>
$(function () {
    $('#pengumumanTable').DataTable({
        responsive: true,
        "columnDefs": [
            { "orderable": false, "targets": [6,7] } // gambar & aksi tidak bisa di-sort
        ]
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/pengumuman/index.blade.php ENDPATH**/ ?>