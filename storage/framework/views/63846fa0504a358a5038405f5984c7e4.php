<?php $__env->startSection('title', 'Form Nilai Inovasi'); ?>

<?php $__env->startPush('style'); ?>
<style>
.table-custom {
    border-collapse: collapse;
    width: 100%;
    font-size: 10px;
}

.table-custom th,
.table-custom td {
    border: 1px solid #dee2e6;
    padding: 8px;
    vertical-align: top;
}

.table-custom th {
    background: #6c757d;
    color: white;
    text-align: center;
}

.plan { background: #fff9c4; }
.do { background: #d4edda; }
.check { background: #cfe2ff; }
.act { background: #f8d7da; }
.creativity { background: #e8f5e9; }

.text-wrap {
    max-width: 220px;
    white-space: pre-line;
}

.nilai {
    width: 60px;
    height: 30px;
    font-size: 12px;
    text-align: center;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Form Nilai Inovasi</h1>
</div>

<div class="section-body">

<div class="card">
<div class="card-body">

<h5 class="text-center mb-4">
    <?php echo e($peserta->name); ?>

</h5>

<form action="<?php echo e(route('juri.nilai.store')); ?>" method="POST">
<?php echo csrf_field(); ?>

<input type="hidden" name="user_id" value="<?php echo e($peserta->id); ?>">

<div class="table-responsive">
<table class="table-custom">

<thead>
<tr>
    <th>Item</th>
    <th>No</th>
    <th>Kriteria</th>
    <th>Keterangan</th>
    <th>Rujukan</th>
    <th>1-4</th>
    <th>5-6</th>
    <th>7-8</th>
    <th>9-10</th>
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

<td class="text-wrap">
    <?php echo e($k->rujukan); ?>

</td>

<td class="text-wrap"><?php echo nl2br(e($k->skala_1_4)); ?></td>
<td class="text-wrap"><?php echo nl2br(e($k->skala_5_6)); ?></td>
<td class="text-wrap"><?php echo nl2br(e($k->skala_7_8)); ?></td>
<td class="text-wrap"><?php echo nl2br(e($k->skala_9_10)); ?></td>

<td class="text-center">
    <input type="text"
           inputmode="numeric"
           pattern="[0-9]*"
           maxlength="2"
           class="form-control nilai"
           name="nilai[<?php echo e($k->id); ?>]"
           value="<?php echo e($nilaiLama[$k->id] ?? ''); ?>"
           data-id="<?php echo e($k->id); ?>">
</td>

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>

<tfoot>
<tr>
    <th colspan="9" class="text-end">TOTAL</th>
    <th id="total">0</th>
</tr>
</tfoot>

</table>
</div>

<div class="mt-4 d-flex justify-content-end gap-2">
    <a href="<?php echo e(route('juri.peserta')); ?>" class="btn btn-secondary">
        Kembali
    </a>

    <button type="submit" class="btn btn-success">
        Simpan Nilai
    </button>
</div>

</form>

</div>
</div>

</div>
</section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function hitung() {
    let total = 0;

    document.querySelectorAll(".nilai").forEach(i => {
        let val = parseInt(i.value);
        if (!isNaN(val)) total += val;
    });

    document.getElementById("total").innerText = total;
}

// VALIDASI INPUT AGAR TIDAK ANEH
document.querySelectorAll(".nilai").forEach(input => {

    input.addEventListener("input", function () {
        let val = this.value.replace(/[^0-9]/g, '');

        if (val > 10) val = 10;
        if (val < 1 && val !== '') val = 1;

        this.value = val;

        hitung();
    });

});

// AUTO HITUNG SAAT LOAD
document.addEventListener("DOMContentLoaded", function () {
    hitung();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/juri/peserta/nilai.blade.php ENDPATH**/ ?>