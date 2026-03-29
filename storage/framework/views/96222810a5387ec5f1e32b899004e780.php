<?php $__env->startSection('title', 'Tambah Pengumuman'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>Edit Timeline</h4>
                </div>

                <div class="card-body">

                    <form action="<?php echo e(route('admin.timeline.update', $timeline->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-3">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan"
                                   class="form-control"
                                   value="<?php echo e(old('urutan', $timeline->urutan)); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul / Tahap</label>
                            <input type="text" name="judul"
                                   class="form-control"
                                   value="<?php echo e(old('judul', $timeline->judul)); ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai"
                                       class="form-control"
                                       value="<?php echo e(old('tanggal_mulai', $timeline->tanggal_mulai)); ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai"
                                       class="form-control"
                                       value="<?php echo e(old('tanggal_selesai', $timeline->tanggal_selesai)); ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" rows="4"
                                      class="form-control"><?php echo e(old('deskripsi', $timeline->deskripsi)); ?></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('admin.pengumuman.index')); ?>"
                               class="btn btn-secondary">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/timeline/edit.blade.php ENDPATH**/ ?>