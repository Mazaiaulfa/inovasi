<?php $__env->startSection('title', 'Tambah Kriteria'); ?>
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

.modern-tabs {
    display: flex;
    gap: 20px;
    border-bottom: 1px solid #e5e7eb;
}

.tab-item {
    padding: 12px 5px;
    cursor: pointer;
    font-weight: 500;
    color: #6b7280;
    position: relative;
}

.tab-item.active {
    color: #4f46e5;
}

.tab-item.active::after {
    content: "";
    position: absolute;
    bottom: -1px;
    width: 100%;
    height: 3px;
    background: #4f46e5;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
<div class="container-fluid">

<div class="card">
<div class="card-header">
    <h4 class="mb-0">Tambah Kriteria</h4>
</div>

<div class="card-body">

<form action="<?php echo e(route('admin.kriteria.store')); ?>" method="POST">
<?php echo csrf_field(); ?>


<div class="card mb-4 border">
    <div class="card-header bg-light">
        <strong>Informasi Kriteria</strong>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <label class="form-label">Item (PLAN / DO / CHECK / ACT)</label>
            <select name="item" class="form-control" required>
                <option value="">-- Pilih --</option>
                <?php $__currentLoopData = ['PLAN','DO','CHECK','ACT','CREATIVITY']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($opt); ?>" <?php echo e(($item ?? '') == $opt ? 'selected' : ''); ?>>
                        <?php echo e($opt); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">No</label>
            <input type="number" name="no" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Kriteria</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Rujukan</label>
            <input type="text" name="rujukan" class="form-control">
        </div>

    </div>
</div>


<div class="card border">
    <div class="card-header bg-light">
        <strong>Skala Penilaian</strong>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <label class="form-label">Skala 1 - 4</label>
            <textarea name="skala_1_4" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Skala 5 - 6</label>
            <textarea name="skala_5_6" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Skala 7 - 8</label>
            <textarea name="skala_7_8" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Skala 9 - 10</label>
            <textarea name="skala_9_10" class="form-control" rows="3" required></textarea>
        </div>

    </div>
</div>


<div class="mt-4 d-flex justify-content-end gap-2">
    <a href="<?php echo e(route('admin.kriteria.index')); ?>" class="btn btn-secondary">
        Kembali
    </a>
    <button type="submit" class="btn btn-primary">
        Simpan
    </button>
</div>

</form>

</div>
</div>

</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
$(function () {
    $('.kriteriaTable').DataTable({
        responsive: true
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/kriteria/create.blade.php ENDPATH**/ ?>