<?php $__env->startSection('title', 'Penetapan Peserta'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.main-content {
    padding-top: 20px;
}

.table-hover tbody tr:hover {
    background-color: #f9fafb;
}

.action-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    Penetapan Peserta
                    <small class="text-muted">(<?php echo e($juri->name); ?>)</small>
                </h5>

                <span class="badge bg-primary">
                    Terpilih: <span id="totalSelected">0</span>
                </span>
            </div>

            <div class="card-body">

                <!-- SEARCH + SELECT ALL -->
                <div class="action-bar">
                    <input type="text" id="search" class="form-control w-50"
                        placeholder="Cari nama / departemen...">

                    <button type="button" id="selectAll" class="btn btn-outline-primary btn-sm">
                        Pilih Semua
                    </button>
                </div>

                <form action="<?php echo e(route('admin.juri.assign')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="juri_id" value="<?php echo e($juri->id); ?>">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">No</th>
                                    <th width="50">✔</th>
                                    <th>Nama Gugus</th>
                                    <th>Email</th>
                                    <th>Departemen</th>
                                    <th>Juri Penilai</th>
                                </tr>
                            </thead>
                            <tbody id="pesertaTable">
                                <?php $__currentLoopData = $peserta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="peserta-row">
                                    <td><?php echo e($loop->iteration); ?></td> 
                                    <td class="text-center">
                                        <input type="checkbox"
                                            class="form-check-input peserta-checkbox"
                                            name="peserta_id[]"
                                            value="<?php echo e($p->id); ?>"
                                            <?php echo e(in_array($p->id, $selected) ? 'checked' : ''); ?>>
                                    </td>
                                    <td><?php echo e($p->name); ?></td>
                                    <td><?php echo e($p->email); ?></td>
                                    <td><?php echo e($p->unit_kerja ?? '-'); ?></td>
                                    <td>
                                    <?php if($p->juriPenilai->count()): ?>
                                        <?php $__currentLoopData = $p->juriPenilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge bg-info text-dark mb-1">
                                                <?php echo e($j->name); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <span class="text-muted">Belum ada</span>
                                    <?php endif; ?>
                                </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3 d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            Simpan
                        </button>

                        <a href="<?php echo e(route('admin.juri.index')); ?>" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const search = document.getElementById('search');
const rows = document.querySelectorAll('.peserta-row');
const checkboxes = document.querySelectorAll('.peserta-checkbox');
const totalSelected = document.getElementById('totalSelected');
const selectAllBtn = document.getElementById('selectAll');

// 🔍 SEARCH
search.addEventListener('keyup', function() {
    let value = this.value.toLowerCase();

    rows.forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value)
            ? '' : 'none';
    });
});

// ✅ COUNT SELECTED
function updateCount() {
    let count = document.querySelectorAll('.peserta-checkbox:checked').length;
    totalSelected.innerText = count;
}

updateCount();

checkboxes.forEach(cb => {
    cb.addEventListener('change', updateCount);
});

// 🔥 SELECT ALL
selectAllBtn.addEventListener('click', function() {
    let allChecked = [...checkboxes].every(cb => cb.checked);

    checkboxes.forEach(cb => {
        cb.checked = !allChecked;
    });

    updateCount();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/juri/assign.blade.php ENDPATH**/ ?>