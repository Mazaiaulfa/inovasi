<?php $__env->startSection('title', 'Konvensi Inovasi'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
.table-konvensi {
    width: 100%;
    border-collapse: collapse;
    font-size: 11px;
}
.table-konvensi th,
.table-konvensi td {
    border: 1px solid #000;
    padding: 5px;
}
.table-konvensi th {
    background: #ffaa01;
    text-align: center;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Konvensi Inovasi</h1>
</div>

<div class="card">
<div class="card-body">
<div class="mb-3 d-flex justify-content-between align-items-center">

    <div></div> 

    <a href="<?php echo e(route('admin.konvensi.export')); ?>"
       class="btn btn-success btn-sm d-flex align-items-center gap-2">
        <i class="bi bi-file-earmark-excel"></i>
        Export Excel
    </a>

</div>
<div class="table-responsive">
<table class="table-konvensi">

<thead>
<tr>
    <th>No</th>
    <th>Nama Gugus</th>
    <th>Judul Karya</th>
    <th>Direktorat</th>
    <th>Kompartemen</th>
    <th>Departemen</th>
    <th>Total</th>
    <th>Apresiasi</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td class="text-center"><?php echo e($i+1); ?></td>

    
    <td><?php echo e($item->karya->user->name); ?></td>

    
    <td><?php echo e($item->karya->judul ?? '-'); ?></td>

    
    <td><?php echo e($item->karya->user->direktorat ?? '-'); ?></td>
    <td><?php echo e($item->karya->user->kompartemen ?? '-'); ?></td>
    <td><?php echo e($item->karya->user->unit_kerja ?? '-'); ?></td>

    
    <td class="text-center">
        <b><?php echo e(round($item->rata_nilai, 2)); ?></b>
    </td>

    
    <td class="text-center">
        <?php $a = $item->apresiasi; ?>

        <?php if($a == 'Diamond'): ?>
            <span class="">💎 Diamond</span>
        <?php elseif($a == 'Platinum'): ?>
            <span class="">Platinum</span>
        <?php elseif($a == 'Gold'): ?>
            <span class="">Gold</span>
        <?php elseif($a == 'Silver'): ?>
            <span class="">Silver</span>
        <?php elseif($a == 'Bronze'): ?>
            <span class="">Bronze</span>
        <?php else: ?>
            -
        <?php endif; ?>
    </td>

    
    <td class="text-center">
    <?php if($item->is_complete): ?>
        <span style="color: green; font-weight: bold;">
            Sudah Dinilai Semua Juri
        </span>
    <?php else: ?>
        <span style="color: red; font-weight: bold;">
            Belum Dinilai Semua Juri
        </span>
    <?php endif; ?>
</td>

    
    <td class="text-center">

        
        <a href="<?php echo e(route('admin.nilai.show', $item->karya_id)); ?>"
           class="btn btn-info btn-sm me-1">
            <i class="bi bi-eye"></i>
        </a>

    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>

</table>
</div>

</div>
</div>

</section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/konvensi/index.blade.php ENDPATH**/ ?>