<?php $__env->startSection('title', 'Konvensi Inovasi'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
.card {
    border: none;
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.05);
    background: #fff;
}

.section-header h1 {
    font-weight: 700;
}

.table-konvensi {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 13px;
    background: #fff;
}

.table-konvensi thead th {
    background: #f8fafc;
    color: #333;
    font-weight: 600;
    text-align: center;
    padding: 12px;
    border-bottom: 1px solid #e5e7eb;
}

.table-konvensi tbody td {
    padding: 12px;
    border-bottom: 1px solid #f1f1f1;
    color: #444;
    vertical-align: middle;
    background: #fff;
}

.table-konvensi tbody tr:hover {
    background: #f9fbff;
}

.table-responsive {
    border-radius: 12px;
    overflow: hidden;
}

/* STATUS */
.status {
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.status.done {
    color: #1f7a3a;
}

.status.pending {
    color: #c0392b;
}

/* BUTTON */
.btn-sm {
    border-radius: 8px;
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

<div class="mb-3 d-flex justify-content-end">
    <a href="<?php echo e(route('admin.konvensi.export')); ?>"
       class="btn btn-success btn-sm">
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
        <?php echo e($item->apresiasi ?? '-'); ?>

    </td>

    
    <td class="text-center">
        <?php if($item->is_complete): ?>
            <span class="status done">Complete</span>
        <?php else: ?>
            <span class="status pending">In Progress</span>
        <?php endif; ?>
    </td>

    
    <td class="text-center">
        <a href="<?php echo e(route('admin.nilai.show', $item->karya_id)); ?>"
           class="btn btn-primary btn-sm"><i class="bi bi-ticket-detailed-fill"></i>        </a>
         <button
            class="btn btn-warning btn-sm btn-edit"
            data-id="<?php echo e($item->id); ?>"
            data-nilai="<?php echo e($item->rata_nilai); ?>"
            data-bs-toggle="modal"
            data-bs-target="#modalEdit"><i class="bi bi-pen-fill"></i>

        </button>

    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>

</table>


</div>



<div class="mt-3 d-flex justify-content-end gap-2">

    
    <small class="text-muted align-self-center me-2">
        Pastikan semua data sudah selesai dinilai sebelum finalisasi
    </small>

    
    <form action="<?php echo e(route('admin.nilai.finalize')); ?>"
          method="POST"
          onsubmit="return confirm('Yakin ingin finalisasi semua data? Setelah ini data akan dikunci.')">
        <?php echo csrf_field(); ?>

        <button type="submit"
            class="btn btn-success btn-sm px-4"
            <?php if($data->where('is_complete', false)->count() > 0): ?> disabled <?php endif; ?>>
            Finalisasi Semua
        </button>
    </form>
</div>
</div>
</div>
</section>
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius:12px">

      <form id="formEdit" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="modal-header">
          <h5 class="modal-title">Edit Rata Nilai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <input type="hidden" id="edit_id">

          <div class="mb-3">
            <label class="form-label">Rata Nilai</label>
            <input type="number" step="0.01" name="rata_nilai"
                   id="edit_nilai"
                   class="form-control"
                   required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success px-4">
            Simpan
          </button>
        </div>

      </form>

    </div>
  </div>
</div>
</div><script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('modalEdit');

    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        var id = button.getAttribute('data-id');
        var nilai = button.getAttribute('data-nilai');

        document.getElementById('edit_nilai').value = nilai;
        document.getElementById('formEdit').action = `/admin/konvensi/${id}`;
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/konvensi/index.blade.php ENDPATH**/ ?>