<?php $__env->startSection('title', 'Penetapan Juri'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.dataTables_wrapper .dataTables_filter {
    display: flex !important;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    flex-direction: row-reverse;
}

.main-content {
    padding-top: 20px;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>Daftar Juri</h4>
                </div>

                <div class="card-body">
                    <div class="mb-3 d-flex justify-content-between">
                    <h6 class="mb-0 text-muted">Manajemen Data Juri</h6>

                    <a href="<?php echo e(route('admin.juri.create')); ?>" class="btn btn-primary btn-sm">
                         Add Juri
                    </a>
                </div>
                    <div class="table-responsive">
                        <table id="juriTable" class="table table-striped table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $juri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td><?php echo e($item->email); ?></td>
                                                        <td class="d-flex gap-1">

                            
                            <a href="<?php echo e(route('admin.juri.assign.form', $item->id)); ?>"
                            class="btn btn-primary btn-sm"
                            title="Penetapan">
                               <i class="fas fa-users-cog"></i>
                            </a>

                            
                            <a href="<?php echo e(route('admin.juri.peserta', $item->id)); ?>"
                            class="btn btn-info btn-sm"
                            title="Lihat Gugus">
                                <i class="fas fa-eye"></i>
                            </a>

                            
                            <a href="<?php echo e(route('admin.juri.edit', $item->id)); ?>"
                            class="btn btn-warning btn-sm"
                            title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>

                            
                            <form action="<?php echo e(route('admin.juri.destroy', $item->id)); ?>"
                                method="POST"
                                onsubmit="return confirm('Yakin mau hapus data ini?')"
                                class="d-inline">

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </form>

                        </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
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
    $('#juriTable').DataTable({
        responsive: true,
        columnDefs: [
            { orderable: false, targets: [3] }
        ]
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/juri/index.blade.php ENDPATH**/ ?>