<?php $__env->startSection('title', 'Edit Pengumuman'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="card" style="max-width: 900px; margin: 0 auto;">
                        <div class="card-header">
                            <h4 class="m-0">Edit Pengumuman</h4>
                        </div>

                        <div class="card-body">

                            
                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <form action="<?php echo e(route('admin.pengumuman.update', $pengumuman)); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Judul</label>
                                    <input type="text"
                                           name="judul"
                                           value="<?php echo e(old('judul', $pengumuman->judul)); ?>"
                                           class="form-control">
                                </div>

                                
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Ringkasan</label>
                                    <textarea name="ringkasan" rows="2"
                                              class="form-control"><?php echo e(old('ringkasan', $pengumuman->ringkasan)); ?></textarea>
                                </div>

                                
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Isi Pengumuman</label>
                                    <textarea name="isi" rows="5"
                                              class="form-control"><?php echo e(old('isi', $pengumuman->isi)); ?></textarea>
                                </div>

                                
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Gambar</label>

                                    <?php if($pengumuman->gambar): ?>
                                        <div class="mb-2">
                                            <img src="<?php echo e(asset($pengumuman->gambar)); ?>"
                                                 style="max-width:200px"
                                                 class="img-thumbnail">
                                        </div>
                                    <?php endif; ?>

                                    <input type="file" name="gambar" class="form-control">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti file</small>
                                </div>

                                
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Urutan</label>
                                    <input type="number"
                                           name="urutan"
                                           value="<?php echo e(old('urutan', $pengumuman->urutan)); ?>"
                                           class="form-control"
                                           min="0">
                                    <small class="text-muted">
                                        Semakin kecil angka, semakin depan tampilannya
                                    </small>
                                </div>

                                
                                <div class="form-check form-switch mb-4">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="is_active"
                                           value="1"
                                           <?php echo e($pengumuman->is_active ? 'checked' : ''); ?>>
                                    <label class="form-check-label">
                                        Aktifkan Pengumuman
                                    </label>
                                </div>

                                
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        Update Pengumuman
                                    </button>

                                    <a href="<?php echo e(route('admin.pengumuman.index')); ?>"
                                       class="btn btn-secondary">
                                        Batal
                                    </a>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/pengumuman/edit.blade.php ENDPATH**/ ?>