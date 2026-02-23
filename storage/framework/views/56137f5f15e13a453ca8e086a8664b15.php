<?php $__env->startSection('title', 'Profile Saya'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile Saya</h1>
        </div>

        <div class="section-body">
            <div class="row">

                <!-- UPDATE PROFILE -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                        </div>

                        <div class="card-body">

                            <?php if(session('success')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('success')); ?>

                                </div>
                            <?php endif; ?>

                            <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                <div class="form-group">
                                    <label>Nama Gugus</label>
                                    <input type="text" name="name"
                                        class="form-control"
                                        value="<?php echo e(old('name', Auth::user()->name)); ?>"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Unit Kerja</label>
                                    <input type="text" name="unit_kerja"
                                        class="form-control"
                                        value="<?php echo e(old('unit_kerja', Auth::user()->unit_kerja)); ?>"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email"
                                        class="form-control"
                                        value="<?php echo e(old('email', Auth::user()->email)); ?>"
                                        required>
                                </div>

                                <hr>
                                <h6>Ganti Password (Opsional)</h6>
                                <small class="text-muted">
                                    Kosongkan jika tidak ingin mengganti password.
                                </small>

                                <div class="form-group mt-2">
                                    <label>Password Baru</label>
                                    <input type="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Isi jika ingin mengganti password">
                                </div>

                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input type="password"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Ulangi password baru">
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- DELETE ACCOUNT -->
                <div class="col-md-4">
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            <h4>Hapus Akun</h4>
                        </div>

                        <div class="card-body">
                            <p class="text-danger">
                                Menghapus akun akan menghapus semua data secara permanen.
                            </p>

                            <form action="<?php echo e(route('admin.profile.destroy')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <div class="form-group">
                                    <label>Masukkan Password</label>
                                    <input type="password"
                                        name="password"
                                        class="form-control"
                                        required>
                                </div>

                                <button type="submit"
                                    class="btn btn-danger btn-block"
                                    onclick="return confirm('Yakin ingin menghapus akun?')">
                                    Hapus Akun
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/profile/index.blade.php ENDPATH**/ ?>