<?php $__env->startSection('title', 'Profile Saya'); ?>

<?php $__env->startPush('style'); ?>
<style>
:root{
    --primary:#4f46e5;
    --primary2:#7c3aed;
    --danger:#dc2626;
    --danger2:#ef4444;
    --soft:#f8fafc;
    --border:#e5e7eb;
    --text:#111827;
    --muted:#6b7280;
}

.profile-card,
.delete-card{
    border: none;
    border-radius: 22px;
    overflow: hidden;
    background: #fff;
}

.profile-card{
    box-shadow: 0 12px 35px rgba(0,0,0,0.05);
}

.delete-card{
    box-shadow: 0 12px 35px rgba(220,38,38,0.08);
}

.profile-header{
    background: linear-gradient(135deg, var(--primary), var(--primary2));
    padding: 32px;
    color: white;
}

.delete-header{
    background: linear-gradient(135deg, var(--danger), var(--danger2));
    padding: 28px;
    color: white;
}

.profile-header h4,
.delete-header h4{
    margin: 0;
    font-weight: 700;
    font-size: 22px;
}

.profile-header small,
.delete-header small{
    opacity: .9;
    font-size: 14px;
}

.form-section{
    padding: 30px;
}

.form-group{
    margin-bottom: 22px;
}

.section-title-small{
    display: block;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 8px;
    color: var(--text);
}

.form-control{
    height: 52px;
    border-radius: 14px;
    border: 1px solid var(--border);
    background: #fff;
    padding: 0 16px;
    font-size: 14px;
    box-shadow: none !important;
    transition: .2s;
}

.form-control:focus{
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(79,70,229,0.08) !important;
}

.password-box{
    background: var(--soft);
    border: 1px solid #eef2f7;
    border-radius: 18px;
    padding: 24px;
    margin-top: 10px;
}

.password-title{
    font-size: 16px;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 4px;
}

.password-sub{
    font-size: 13px;
    color: var(--muted);
    margin-bottom: 20px;
}

.btn-modern{
    border: none;
    border-radius: 14px;
    padding: 13px 28px;
    font-weight: 600;
    font-size: 14px;
    transition: .2s;
}

.btn-save{
    background: linear-gradient(135deg, var(--primary), var(--primary2));
    color: white;
}

.btn-save:hover{
    transform: translateY(-2px);
    color: white;
    box-shadow: 0 10px 20px rgba(79,70,229,0.18);
}

.btn-delete-modern{
    border-radius: 14px;
    padding: 13px;
    font-weight: 600;
    font-size: 14px;
}

.info-danger{
    background: #fff5f5;
    border: 1px solid #ffe2e2;
    padding: 14px;
    border-radius: 14px;
    color: #b91c1c;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.alert{
    border-radius: 14px;
    border: none;
}

@media(max-width:768px){
    .profile-header,
    .delete-header{
        padding: 24px;
    }

    .form-section{
        padding: 22px;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Profile Saya</h1>
        </div>

        <div class="section-body">
            <div class="row">

                <!-- EDIT PROFILE -->
                <div class="col-lg-8">

                    <div class="card profile-card">

                        <div class="profile-header">
                            <h4>Edit Profile</h4>
                            <small>
                                Kelola informasi akun dan data profil Anda
                            </small>
                        </div>

                        <div class="form-section">

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('success')); ?>

                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            

<form action="<?php echo e(route('user.profile.update')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    
    <div class="form-group">
        <label class="section-title-small">
            Nama Gugus
        </label>
        <input
            type="text"
            name="name"
            class="form-control"
            value="<?php echo e(old('name', Auth::user()->name)); ?>"
            required>
    </div>

    
    <div class="form-group">
        <label class="section-title-small">
            Unit Kerja
        </label>
        <input
            type="text"
            name="unit_kerja"
            class="form-control"
            value="<?php echo e(old('unit_kerja', Auth::user()->unit_kerja)); ?>"
            required>
    </div>

    
    <div class="form-group">
        <label class="section-title-small">
            Email
        </label>
        <input
            type="email"
            name="email"
            class="form-control"
            value="<?php echo e(old('email', Auth::user()->email)); ?>"
            required>
    </div>

   
    <div class="form-group">
        <label class="section-title-small">
            Password Baru (Kosongkan jika tidak ingin mengganti password)
        </label>
        <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Kosongkan jika tidak ingin mengganti password">
    </div>

    <div class="form-group">
        <label class="section-title-small">
            Konfirmasi Password
        </label>
        <input
            type="password"
            name="password_confirmation"
            class="form-control"
            placeholder="Ulangi password baru">
    </div>

    <div class="mt-4">
        <button
            type="submit"
            class="btn btn-modern btn-save">
            Simpan Perubahan
        </button>
    </div>

</form>
                        </div>
                    </div>
                </div>

                <!-- DELETE ACCOUNT -->
                <div class="col-lg-4">

                    <div class="card delete-card">

                        <div class="delete-header">
                            <h4>Hapus Akun</h4>
                            <small>
                                Tindakan permanen dan tidak dapat dibatalkan
                            </small>
                        </div>

                        <div class="form-section">

                            <div class="info-danger">
                                Menghapus akun akan menghapus seluruh data secara permanen
                                dan tidak dapat dipulihkan kembali.
                            </div>

                            <form
                                action="<?php echo e(route('user.profile.destroy')); ?>"
                                method="POST">

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <div class="form-group">
                                    <label class="section-title-small">
                                        Masukkan Password
                                    </label>

                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Konfirmasi password"
                                        required>
                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-block btn-delete-modern"
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/user/profile/index.blade.php ENDPATH**/ ?>