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

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$rowspan = count($rows);
$class = strtolower($item);
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr class="<?php echo e($class); ?>">

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($index == 0): ?>
<td rowspan="<?php echo e($rowspan); ?>" class="text-center fw-bold">
    <?php echo e($item); ?>

</td>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

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
       class="form-control nilai"
       name="nilai[<?php echo e($k->id); ?>]"
       value="<?php echo e(isset($nilaiLama[$k->id]) ? (float)$nilaiLama[$k->id] : ''); ?>"
       data-id="<?php echo e($k->id); ?>"
       placeholder="0-10">
</td>

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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

    document.querySelectorAll(".nilai").forEach(input => {

        let val = parseFloat(input.value);

        if (!isNaN(val)) {
            total += val;
        }

    });

    document.getElementById("total").innerText =
    total % 1 === 0 ? total : total.toFixed(2);
}

document.querySelectorAll(".nilai").forEach(input => {

    input.addEventListener("input", function () {

        let value = this.value;

        // hanya angka dan titik
        value = value.replace(/[^0-9.]/g, '');

        // hanya boleh satu titik
        let parts = value.split('.');
        if(parts.length > 2){
            value = parts[0] + '.' + parts.slice(1).join('');
        }

        let angka = parseFloat(value);

        if(!isNaN(angka) && angka > 10){
            value = '10';
        }

        this.value = value;

        hitung();
    });

});

document.addEventListener("DOMContentLoaded", function () {
    hitung();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/juri/peserta/nilai.blade.php ENDPATH**/ ?>