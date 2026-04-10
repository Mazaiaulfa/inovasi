<?php $__env->startSection('title', 'Kelola Kriteria'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
.main-content {
    padding-top: 20px;
}


.modal-body ol {
    padding-left: 20px;
}

.modal-body li {
    margin-bottom: 5px;
}

.table td, .table th {
    vertical-align: middle;
    font-size: 13px;
}

td {
    max-width: 180px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* 🔥 TAB BAGUS */
.nav-tabs .nav-link {
    border: none;
    color: #555;
    font-weight: 500;
}

.nav-tabs .nav-link.active {
    background-color: #7ea0d2;
    color: white;
    border-radius: 12px;
}

/*AKSI BIAR GA TURUN */
.aksi-btn {
    display: flex;
    gap: 6px;
    justify-content: center;
    white-space: nowrap;
}

.aksi-btn form {
    margin: 0;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
<div class="container-fluid">
<div class="card">

<div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Kelola Kriteria Penilaian</h4>

    <a href="<?php echo e(route('admin.kriteria.create')); ?>" class="btn btn-primary">
        + Add Kriteria
    </a>
</div>

<div class="card-body">

<!-- TAB -->
<ul class="nav nav-tabs mb-3">
<?php $__currentLoopData = $kriterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="nav-item">
        <button class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>"
                data-bs-toggle="tab"
                data-bs-target="#<?php echo e(strtolower($item)); ?>">
            <?php echo e(strtoupper($item)); ?>

        </button>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

<!-- CONTENT -->
<div class="tab-content">

<?php $__currentLoopData = $kriterias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>" id="<?php echo e(strtolower($item)); ?>">

<div class="mb-3">
    <a href="<?php echo e(route('admin.kriteria.create')); ?>?item=<?php echo e($item); ?>" class="btn btn-primary">
        + Tambah <?php echo e($item); ?>

    </a>
</div>

<div class="table-responsive">
<table class="table table-bordered table-striped align-middle">
<thead class="table-secondary">
<tr>
    <th width="5%">No</th>
    <th>Kriteria</th>
    <th>Keterangan</th>
    <th>Rujukan</th>
    <th width="10%">Skala</th>
    <th width="12%">Aksi</th>
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

<td class="aksi-btn">

    <!-- EDIT -->
    <a href="<?php echo e(route('admin.kriteria.edit', $k->id)); ?>"
       class="btn btn-sm btn-warning"
       data-bs-toggle="tooltip"
       title="Edit">
        <i class="bi bi-pencil"></i>
    </a>

    <!-- DELETE -->
    <form action="<?php echo e(route('admin.kriteria.destroy', $k->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit"
                class="btn btn-sm btn-danger"
                data-bs-toggle="tooltip"
                title="Hapus"
                onclick="return confirm('Yakin hapus?')">
            <i class="bi bi-trash"></i>
        </button>
    </form>

</td>
</tr>

<!-- MODAL -->
<div class="modal fade" id="modal<?php echo e($k->id); ?>" tabindex="-1">
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
        $text = trim($text);
        $text = preg_replace('/^\d+\.\s*/', '', $text);
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
        $text = trim($text);
        $text = preg_replace('/^\d+\.\s*/', '', $text);
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
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (el) {
        return new bootstrap.Tooltip(el)
    })
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/kriteria/index.blade.php ENDPATH**/ ?>