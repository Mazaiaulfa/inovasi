<?php $__env->startSection('title', 'Konvensi Inovasi'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
    vertical-align: middle;
}

.table-konvensi th {
    background: #ffe600; /* 🔥 kuning */
    text-align: center;
    font-weight: bold;
}

.table-konvensi tbody tr:hover {
    background-color: #fffde7; /* hover kuning soft */
}

.text-center {
    text-align: center;
}

.badge {
    font-size: 10px;
    padding: 4px 6px;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Konvensi Inovasi</h1>
</div>

<div class="section-body">
<div class="card">

<div class="card-header">
    <h4 class="mb-0">Hasil Penilaian</h4>
</div>

<div class="card-body">

<div class="table-responsive">
<table class="table-konvensi">

<thead>
<tr>
    <th width="40">No</th>
    <th>Nama</th>
    <th>Direktorat</th>
    <th>Kompartemen</th>
    <th>Departemen</th>
    <th width="80">Total</th>
    <th width="120">Apresiasi</th>
    <th width="100">Aksi</th>
</tr>
</thead>

<tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>

    <td class="text-center"><?php echo e($i+1); ?></td>

    <td><?php echo e($item->peserta->name); ?></td>
    <td><?php echo e($item->peserta->direktorat ?? '-'); ?></td>
    <td><?php echo e($item->peserta->kompartemen ?? '-'); ?></td>
    <td><?php echo e($item->peserta->unit_kerja ?? '-'); ?></td>

    <td class="text-center">
        <b><?php echo e($item->total_nilai); ?></b>
    </td>

    
    <td class="text-center">
        <?php $a = $item->apresiasi; ?>

        <?php if($a == 'Diamond'): ?>
            <span class="badge bg-primary">💎 Diamond</span>
        <?php elseif($a == 'Platinum'): ?>
            <span class="badge bg-info">Platinum</span>
        <?php elseif($a == 'Gold'): ?>
            <span class="badge bg-warning text-dark">Gold</span>
        <?php elseif($a == 'Silver'): ?>
            <span class="badge bg-secondary">Silver</span>
        <?php elseif($a == 'Bronze'): ?>
            <span class="badge bg-dark">Bronze</span>
        <?php else: ?>
            -
        <?php endif; ?>
    </td>

    
    <td class="text-center">

        <?php if($item->status != 'published'): ?>

            
            <a href="<?php echo e(route('admin.nilai.detail', $item->id)); ?>"
               class="btn btn-info btn-sm"
               title="Detail">
                👁
            </a>

            
            <a href="<?php echo e(route('admin.nilai.edit', $item->id)); ?>"
               class="btn btn-warning btn-sm"
               title="Edit">
                ✏️
            </a>

        <?php else: ?>
            <span class="badge bg-dark">🔒</span>
        <?php endif; ?>

    </td>

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>

</table>
</div>


<div class="mt-4 text-end">
    <form action="<?php echo e(route('admin.publish')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <button class="btn btn-danger"
            onclick="return confirm('Finalisasi semua data? Tidak bisa diubah lagi!')">
            Finalisasi
        </button>
    </form>
</div>

</div>
</div>

</div>
</section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/konvensi/index.blade.php ENDPATH**/ ?>