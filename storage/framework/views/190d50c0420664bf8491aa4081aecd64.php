<?php $__env->startSection('title', 'Show Nilai Peserta'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.table-custom {
    border-collapse: collapse;
    width: 100%;
    font-size: 12px;
}

.table-custom th,
.table-custom td {
    border: 1px solid #dee2e6;
    padding: 8px;
    vertical-align: middle;
}

.table-custom th {
    background: #6c757d;
    color: white;
    text-align: center;
}

.status-ok {
    color: green;
    font-weight: bold;
}

.status-bad {
    color: red;
    font-weight: bold;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Edit Nilai Peserta</h1>
</div>

<div class="section-body">
<div class="card">
<div class="card-body">




<h5 class="text-center mb-3">
    <?php echo e($karya->user->name); ?>

</h5>

<div class="mb-3 text-center">
    <b>Judul:</b> <?php echo e($karya->judul); ?> <br>
    <b>Direktorat:</b> <?php echo e($karya->user->direktorat ?? '-'); ?> |
    <b>Kompartemen:</b> <?php echo e($karya->user->kompartemen ?? '-'); ?> |
    <b>Departemen:</b> <?php echo e($karya->user->unit_kerja ?? '-'); ?>

</div>

<hr>




<div class="table-responsive">
<table class="table-custom">

<thead>
<tr>
    <th width="50">No</th>
    <th>Nama Juri</th>
    <th width="120">Total Nilai</th>
    <th width="150">Status</th>
    <th width="120">Aksi</th>
</tr>
</thead>

<tbody>
<?php $__currentLoopData = $penilaians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>

    <td class="text-center"><?php echo e($i+1); ?></td>

    <td><?php echo e($p->juri->name); ?></td>

    <td class="text-center">
        <b><?php echo e($p->total_nilai ?? '-'); ?></b>
    </td>

    
    <td class="text-center">
        <?php if($p->status == 'submitted'): ?>
            <span class="status-ok">Sudah Dinilai</span>
        <?php else: ?>
            <span class="status-bad">Belum Dinilai</span>
        <?php endif; ?>
    </td>

    
    <td class="text-center">

        
        <a href="<?php echo e(route('admin.nilai.detail', $p->id)); ?>"
           class="btn btn-info btn-sm">
            <i class="bi bi-eye"></i> Lihat
        </a>

        
        <?php if($p->status != 'published'): ?>
            <a href="<?php echo e(route('admin.nilai.edit', $p->id)); ?>"
               class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-square">Edit </i>
            </a>
        <?php endif; ?>

    </td>

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>

</table>
</div>




<div class="mt-4">
    <a href="<?php echo e(route('admin.konvensi.index')); ?>" class="btn btn-secondary">
        Kembali
    </a>
</div>

</div>
</div>
</div>

</section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/konvensi/show.blade.php ENDPATH**/ ?>