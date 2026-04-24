<?php $__env->startSection('title', 'Kelola Kriteria'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    background: #f6f8fb;
}

/* CARD */
.card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.06);
    background: #fff;
}

/* HEADER */
.card-header {
    background: #fff;
    border-bottom: 1px solid #eef2f7;
}

.card-header h4 {
    font-weight: 700;
    color: #1f2937;
}

/* TABS MODERN */
.modern-tabs {
    border-bottom: 1px solid #eef2f7;
}

.modern-tabs .nav-link {
    border: none !important;
    background: none !important;
    color: #6b7280;
    font-weight: 500;
    position: relative;
    padding: 10px 14px;
}

.modern-tabs .nav-link.active {
    color: #4f46e5 !important;
}

.modern-tabs .nav-link.active::after {
    content: "";
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 3px;
    background: #4f46e5;
    border-radius: 3px;
}

/* TABLE */
.table {
    font-size: 13px;
}

.table thead th {
    background: #f8fafc !important;
    color: #374151;
    font-weight: 600;
    border-bottom: 1px solid #e5e7eb !important;
}

.table tbody td {
    vertical-align: middle;
    color: #374151;
    background: #fff;
    border-color: #f1f5f9;
}

.table tbody tr:hover {
    background: #f3f8ff;
}

/* LIMIT TEXT */
td {
    max-width: 180px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* ACTION BUTTON */
.aksi-btn {
    display: flex;
    justify-content: center;
    gap: 6px;
}

.aksi-btn a,
.aksi-btn button {
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    padding: 0;
}

/* BUTTON COLORS SOFT */
.btn-warning {
    background: #fbbf24;
    border: none;
    color: #fff;
}

.btn-danger {
    background: #ef4444;
    border: none;
}

.btn-info {
    background: #3b82f6;
    border: none;
    color: #fff;
}

/* MODAL CLEAN */
.modal-content {
    border-radius: 14px;
    border: none;
}

.modal-header {
    border-bottom: 1px solid #eef2f7;
}

/* CARD BODY SPACING */
.card-body {
    padding-top: 16px;
}

.aksi-btn {
    display: flex;
    justify-content: center;
    gap: 6px;
}

/* BUTTON ICON STYLE */
.aksi-btn a,
.aksi-btn button {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    padding: 0;
    border: none;
    color: #fff;
    transition: 0.2s ease;
}

/* HOVER EFFECT */
.aksi-btn a:hover,
.aksi-btn button:hover {
    transform: translateY(-1px);
    filter: brightness(0.95);
}

/* WARNA BUTTON ICON */
.btn-edit {
    background: #fbbf24; /* kuning */
}

.btn-delete {
    background: #ef4444; /* merah */
}

.btn-view {
    background: #3b82f6; /* biru */
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
<div class="container-fluid">

<div class="card">

<div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Kelola Kriteria Penilaian</h4>

    <a href="<?php echo e(route('admin.kriteria.create')); ?>" class="btn btn-primary btn-sm">
        + Add Kriteria
    </a>
</div>

<div class="card-body">


<ul class="nav modern-tabs mb-3">
<?php $__currentLoopData = $kriterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="nav-item">
        <button class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>"
                data-bs-toggle="tab"
                data-bs-target="#<?php echo e(strtolower($item)); ?>">

            <?php
                $icon = match(strtolower($item)){
                    'plan' => 'bi-lightbulb',
                    'do' => 'bi-gear',
                    'check' => 'bi-check2-square',
                    'act' => 'bi-arrow-repeat',
                    'creativity' => 'bi-stars',
                    default => 'bi-folder'
                };
            ?>

            <i class="bi <?php echo e($icon); ?> me-1"></i>
            <?php echo e(strtoupper($item)); ?>

        </button>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>


<div class="tab-content">

<?php $__currentLoopData = $kriterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>"
     id="<?php echo e(strtolower($item)); ?>">

<div class="table-responsive">
<table class="table table-hover align-middle">

<thead>
<tr>
    <th>No</th>
    <th>Kriteria</th>
    <th>Keterangan</th>
    <th>Rujukan</th>
    <th>Skala</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($k->no); ?></td>
    <td><?php echo e($k->nama); ?></td>
    <td><?php echo e(Str::limit($k->keterangan, 40)); ?></td>
    <td><?php echo e(Str::limit($k->rujukan, 30)); ?></td>

    <td class="text-center">
        <button class="btn btn-sm btn-info"
                data-bs-toggle="modal"
                data-bs-target="#modal<?php echo e($k->id); ?>">
            <i class="bi bi-eye"></i>
        </button>
    </td>

    <td>
    <div class="aksi-btn">

        <a href="<?php echo e(route('admin.kriteria.edit', $k->id)); ?>"
           class="btn-edit"
           title="Edit">
            <i class="bi bi-pencil"></i>
        </a>

        <form action="<?php echo e(route('admin.kriteria.destroy', $k->id)); ?>"
              method="POST"
              onsubmit="return confirm('Yakin hapus?')">

            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>

            <button type="submit"
                    class="btn-delete"
                    title="Hapus">
                <i class="bi bi-trash"></i>
            </button>
        </form>

    </div>
</td>
</tr>


<div class="modal fade" id="modal<?php echo e($k->id); ?>">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title"><?php echo e($k->nama); ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<p><strong>Keterangan:</strong></p>
<ol>
<?php $__currentLoopData = explode("\n", $k->keterangan); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $text = trim(preg_replace('/^\d+\.\s*/', '', $text));
    ?>
    <?php if($text): ?>
        <li><?php echo e($text); ?></li>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>

<hr>

<?php $__currentLoopData = [
    '1 - 4' => $k->skala_1_4,
    '5 - 6' => $k->skala_5_6,
    '7 - 8' => $k->skala_7_8,
    '9 - 10' => $k->skala_9_10,
]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<p><strong>Skala <?php echo e($label); ?>:</strong></p>
<ol>
<?php $__currentLoopData = explode("\n", $value); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $text = trim(preg_replace('/^\d+\.\s*/', '', $text));
    ?>
    <?php if($text): ?>
        <li><?php echo e($text); ?></li>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

</div>
</div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</tbody>
</table>
</div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

</div>
</div>

</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/kriteria/index.blade.php ENDPATH**/ ?>