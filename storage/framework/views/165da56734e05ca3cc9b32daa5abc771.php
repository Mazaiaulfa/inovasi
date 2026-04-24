<?php $__env->startSection('title', 'Penetapan Juri'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f6f8fb;
}

/* CARD */
.card {
    border: none;
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 12px 30px rgba(0,0,0,0.06);
}

/* HEADER */
.card-header {
    background: #fff;
    border-bottom: 1px solid #eef2f7;
    font-weight: 600;
}

/* TITLE AREA */
.card-header h4 {
    margin: 0;
    font-weight: 700;
    color: #1f2937;
}

/* TABLE WRAPPER */
.table-responsive {
    border-radius: 12px;
    overflow: hidden;
}

/* TABLE */
table.dataTable {
    border-collapse: separate !important;
    border-spacing: 0;
    width: 100%;
    font-size: 13px;
}

/* HEADER TABLE */
table.dataTable thead th {
    background: linear-gradient(180deg, #ffffff 0%, #f9fafb 100%);
    border-bottom: 1px solid #e5e7eb !important;
    color: #374151;
    font-weight: 600;
    text-align: center;
    padding: 12px;
}

/* BODY */
table.dataTable tbody td {
    padding: 12px;
    border-bottom: 1px solid #f1f5f9;
    color: #374151;
    vertical-align: middle;
    background: #fff;
}

/* ROW HOVER */
table.dataTable tbody tr:hover {
    background: #f3f8ff;
}

/* ACTION BUTTONS */
td .btn {
    border-radius: 10px;
    padding: 6px 10px;
    font-size: 13px;
}

/* ACTION CELL */
td .d-flex {
    gap: 6px;
}

/* ADD BUTTON */
.btn-primary {
    border-radius: 10px;
    font-weight: 500;
}

/* DATATABLE SEARCH */
.dataTables_wrapper .dataTables_filter {
    display: flex !important;
    justify-content: flex-end;
    margin-bottom: 12px;
}

.dataTables_wrapper .dataTables_filter input {
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    padding: 6px 10px;
    outline: none;
}

.dataTables_wrapper .dataTables_length select {
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    padding: 4px 8px;
}

td .btn {
    width: 30px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    padding: 0;
}

td .btn i {
    font-size: 12px;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar Juri</h4>

                    <a href="<?php echo e(route('admin.juri.create')); ?>"
                       class="btn btn-primary btn-sm">
                        Add Juri
                    </a>
                </div>

                <div class="card-body">

                    <div class="mb-3 text-muted">
                        Manajemen Data Juri
                    </div>

                    <div class="table-responsive">
                        <table id="juriTable" class="table w-100">
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
                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td><?php echo e($item->email); ?></td>

                                    <td>
    <div class="d-flex justify-content-center gap-1">

        
        <a href="<?php echo e(route('admin.juri.assign.form', $item->id)); ?>"
           class="btn btn-primary btn-sm"
           title="Penetapan">
            <i class="bi bi-people-fill"></i>
        </a>

        
        <a href="<?php echo e(route('admin.juri.peserta', $item->id)); ?>"
           class="btn btn-info btn-sm"
           title="Lihat Gugus">
            <i class="bi bi-eye"></i>
        </a>

        
        <a href="<?php echo e(route('admin.juri.edit', $item->id)); ?>"
           class="btn btn-warning btn-sm"
           title="Edit">
            <i class="bi bi-pencil-square"></i>
        </a>

        
        <form action="<?php echo e(route('admin.juri.destroy', $item->id)); ?>"
              method="POST"
              onsubmit="return confirm('Yakin mau hapus data ini?')">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>

            <button type="submit"
                    class="btn btn-danger btn-sm"
                    title="Hapus">
                <i class="bi bi-trash"></i>
            </button>
        </form>

    </div>
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
        pageLength: 10,
        columnDefs: [
            { orderable: false, targets: [3] }
        ]
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/juri/index.blade.php ENDPATH**/ ?>