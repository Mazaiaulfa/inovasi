<?php $__env->startSection('title', 'Detail Penilaian'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.table-custom {
    border-collapse: collapse;
    width: 100%;
    font-size: 11px;
}

.table-custom th,
.table-custom td {
    border: 1px solid #000;
    padding: 6px;
    vertical-align: top;
}

.table-custom th {
    background: #ffe600;
    text-align: center;
    font-weight: bold;
}

/* warna item */
.plan { background: #fff9c4; }
.do { background: #d4edda; }
.check { background: #cfe2ff; }
.act { background: #f8d7da; }
.creativity { background: #e8f5e9; }

.text-wrap {
    white-space: pre-line;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Detail Penilaian</h1>
</div>

<div class="section-body">
<div class="card">
<div class="card-body">




<h5 class="text-center mb-3">
    <?php echo e($peserta->name); ?>

</h5>

<div class="mb-3">
    <b>Direktorat:</b> <?php echo e($peserta->direktorat ?? '-'); ?> <br>
    <b>Kompartemen:</b> <?php echo e($peserta->kompartemen ?? '-'); ?> <br>
    <b>Departemen:</b> <?php echo e($peserta->unit_kerja ?? '-'); ?>

</div>

<hr>




<div class="mb-3">
    <b>Total Nilai:</b> <?php echo e($penilaian->total_nilai); ?> <br>



<hr>




<div class="table-responsive">
<table class="table-custom">

<thead>
<tr>
    <th>Item</th>
    <th>No</th>
    <th>Kriteria</th>
    <th>Keterangan</th>
    <th>Nilai</th>
</tr>
</thead>

<tbody>
<?php
$group = $kriteria->groupBy('item');
?>

<?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$rowspan = count($rows);
$class = strtolower($item);
?>

<?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr class="<?php echo e($class); ?>">

<?php if($index == 0): ?>
<td rowspan="<?php echo e($rowspan); ?>" class="text-center fw-bold">
    <?php echo e($item); ?>

</td>
<?php endif; ?>

<td class="text-center"><?php echo e($k->no); ?></td>

<td><?php echo e($k->nama); ?></td>

<td class="text-wrap">
    <?php echo nl2br(e($k->keterangan)); ?>

</td>

<td class="text-center">
    <b><?php echo e($nilaiDetail[$k->id] ?? '-'); ?></b>
</td>

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>

<tfoot>
<tr>
    <th colspan="4" class="text-end">TOTAL</th>
    <th><?php echo e($penilaian->total_nilai); ?></th>
</tr>
</tfoot>

</table>
</div>

<div class="mt-4">
    <a href="<?php echo e(route('admin.nilai.show', $penilaian->karya_id)); ?>" class="btn btn-secondary">
        Kembali
    </a>
</div>

</div>
</div>
</div>

</section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/konvensi/detail.blade.php ENDPATH**/ ?>