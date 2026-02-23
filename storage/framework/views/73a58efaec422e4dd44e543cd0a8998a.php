
<?php $__env->startSection('title', 'Pengajuan Judul'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="m-0">Edit Judul</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?php echo e(route('karya.update', $karya->id)); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        value="<?php echo e(old('judul', $karya->judul)); ?>" required>
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
    <label class="form-label">File Ajukan Saat Ini</label><br>

    <?php if($karya->file_ajukan): ?>
        <a href="<?php echo e(asset($karya->file_ajukan)); ?>"
           target="_blank"
           class="btn btn-sm btn-danger">
            Lihat PDF
        </a>
    <?php else: ?>
        <span class="text-muted">Tidak ada file</span>
    <?php endif; ?>
</div>

                            <div class="mb-3">
    <label for="file_ajukan" class="form-label">
        Ganti File Ajukan (PDF)
    </label>
    <input type="file"
           class="form-control"
           id="file_ajukan"
           name="file_ajukan"
           accept="application/pdf">

    <small class="text-muted">
        Kosongkan jika tidak ingin mengganti file
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
                                    <button type="submit" class="btn btn-warning">Update</button>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/user/karya/edit.blade.php ENDPATH**/ ?>