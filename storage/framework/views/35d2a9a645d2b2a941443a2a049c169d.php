
<?php $__env->startSection('title', 'Edit Gugus'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="m-0">Edit Gugus</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('user.update', $user->id)); ?>" method="POST"
                                enctype="multipart/form-data">
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
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control" required
                                        value="<?php echo e($user->name); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Unit Kerja</label>
                                    <input type="text" name="unit_kerja" class="form-control" required
                                        value="<?php echo e($user->unit_kerja); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="***">
                                    <small class="text-danger">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Kosongkan jika tidak ingin mengubah password.
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo e($user->email); ?>"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="user" <?php echo e($user->role == 'user' ? 'selected' : ''); ?>>User</option>
                                        <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Admin
                                        </option>
                                    </select>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary px-5">
                                        Update
                                    </button>
                                    <a href="<?php echo e(route('user.index')); ?>" class="btn btn-secondary">Batal</a>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/user/edit.blade.php ENDPATH**/ ?>