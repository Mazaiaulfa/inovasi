<?php $__env->startSection('title', 'Pengajuan Judul'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tambah Judul</h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="<?php echo e(route('karya.store')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        value="<?php echo e(old('judul')); ?>" required>
                                    <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="mb-3">
                                <label for="file_ajukan" class="form-label">
                                    File Ajukan (PDF)
                                </label>
                                <input type="file"
                                    class="form-control"
                                    id="file_ajukan"
                                    name="file_ajukan"
                                    accept="application/pdf"
                                    required>

                                <small class="text-muted">
                                    Upload file PDF (maks. 2MB) dengan format "Nama Team.pdf"
                                </small>

                                <?php $__errorArgs = ['file_ajukan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Ajukan</button>
                                    <a href="<?php echo e(route('karya.index')); ?>" class="btn btn-secondary">Batal</a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/user/karya/create.blade.php ENDPATH**/ ?>