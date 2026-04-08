<?php $__env->startSection('title', 'Kelola Kriteria'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
.main-content {
    padding-top: 20px;
}

td {
    max-width: 180px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.modal-body ol {
    padding-left: 20px;
}

.modal-body li {
    margin-bottom: 5px;
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
            <?php echo e($item); ?>

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
<table class="table table-bordered table-striped">
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

    <td>
        <button class="btn btn-sm btn-info"
            data-bs-toggle="modal"
            data-bs-target="#modal<?php echo e($k->id); ?>">
            Lihat
        </button>
    </td>

   <td class="d-flex gap-2 align-items-center">

    <!-- EDIT -->
    <a href="<?php echo e(route('admin.kriteria.edit', $k->id)); ?>"
       class="btn btn-sm btn-warning"
       data-bs-toggle="tooltip"
       title="Edit Data">
        <i class="bi bi-pencil"></i>
    </a>

    <!-- DELETE -->
    <form action="<?php echo e(route('admin.kriteria.destroy', $k->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit"
                class="btn btn-sm btn-danger"
                data-bs-toggle="tooltip"
                title="Hapus Data"
                onclick="return confirm('Yakin hapus data ini?')">
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
<?php $__currentLoopData = explode("\n", $k->keterangan); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $item = trim($item);
        $item = preg_replace('/^\d+\.\s*/', '', $item);
    ?>

    <?php if($item != ''): ?>
        <li><?php echo e($item); ?></li>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>

<hr>


<?php
    function cleanList($text) {
        $lines = explode("\n", $text);
        $result = [];

        foreach ($lines as $line) {
            $line = trim($line);
            // hapus "1." "2." dst
            $line = preg_replace('/^\d+\.\s*/', '', $line);

            if ($line != '') {
                $result[] = $line;
            }
        }

        return $result;
    }
?>

<p><strong>Skala 1 - 4:</strong></p>
<ol>
<?php $__currentLoopData = cleanList($k->skala_1_4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li><?php echo e($item); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>

<p><strong>Skala 5 - 6:</strong></p>
<ol>
<?php $__currentLoopData = cleanList($k->skala_5_6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li><?php echo e($item); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>

<p><strong>Skala 7 - 8:</strong></p>
<ol>
<?php $__currentLoopData = cleanList($k->skala_7_8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li><?php echo e($item); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>

<p><strong>Skala 9 - 10:</strong></p>
<ol>
<?php $__currentLoopData = cleanList($k->skala_9_10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li><?php echo e($item); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>

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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/kriteria/index.blade.php ENDPATH**/ ?>