

<?php $__env->startSection('title', 'Register'); ?>

<?php $__env->startPush('style'); ?>
<!-- CSS Libraries -->
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<link rel="stylesheet" href="<?php echo e(asset('library/bootstrap-social/bootstrap-social.css')); ?>">
<style>
    body {
        background: linear-gradient(135deg, #667eea, #764ba2);
        min-height: 100vh;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        padding: 2rem;
        max-width: 400px;
        width: 100%;

    }

    .login-icon {
        font-size: 3rem;
        color: #4f46e5;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="login-card">
    
    <div class="login-brand mb-2 text-center">
        <img src="<?php echo e(asset('img/logoLogin.png')); ?>" alt="Logo" style="height: 58px; width: auto;">
    </div>

    
    <form method="POST" action="<?php echo e(route('register')); ?>">
        <?php echo csrf_field(); ?>

        
        <div class="form-group mb-1">
            <label for="name" class="font-weight-bold"><i class="fas fa-users mr-1"></i> Nama Team</label>
            <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name"
                value="<?php echo e(old('name')); ?>" required autofocus placeholder="Masukkan Nama Team">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback" style="display:block">
                <?php echo e($message); ?>

            </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

     <div class="form-group mb-1">
    <label for="unit_kerja" class="font-weight-bold">
        <i class="fas fa-building mr-1"></i> Unit Kerja
    </label>

    <select id="unit_kerja"
        name="unit_kerja"
        class="form-control select2 <?php $__errorArgs = ['unit_kerja'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        required>

        <option value="">-- Pilih Unit Kerja --</option>

        <option value="Departement Pengawasan"
            <?php echo e(old('unit_kerja') == 'Departement Pengawasan' ? 'selected' : ''); ?>>
            Departement Pengawasan
        </option>

          <option value="Departement QA, Perencanaan & Pelaporan"
            <?php echo e(old('unit_kerja') == 'Departement QA, Perencanaan & Pelaporan' ? 'selected' : ''); ?>>
            Departement QA, Perencanaan & Pelaporan
        </option>

        <option value="Departement Komunikasi & Administrasi Korporat"
            <?php echo e(old('unit_kerja') == 'Departement Komunikasi & Administrasi Korporat' ? 'selected' : ''); ?>>
            Departement Komunikasi & Administrasi Korporat
        </option>

        <option value="Departement TJSL"
            <?php echo e(old('unit_kerja') == 'Departement TJSL' ? 'selected' : ''); ?>>
            Departement TJSL
        </option>

        <option value="Kantor Perwakilan Jakarta"
            <?php echo e(old('unit_kerja') == 'Kantor Perwakilan Jakarta' ? 'selected' : ''); ?>>
            Kantor Perwakilan Jakarta
        </option>

        <option value="Departement Sistem Manajemen Terpadu & Inovasi"
            <?php echo e(old('unit_kerja') == 'Departement Sistem Manajemen Terpadu & Inovasi' ? 'selected' : ''); ?>>
            Departement Sistem Manajemen Terpadu & Inovasi
        </option>

        <option value="Departement Pengelola Pelanggan"
            <?php echo e(old('unit_kerja') == 'Departement Pengelola Pelanggan' ? 'selected' : ''); ?>>
            Departement Pengelola Pelanggan
        </option>

        <option value="Staf Riset"
            <?php echo e(old('unit_kerja') == 'Staf Riset' ? 'selected' : ''); ?>>
            Staf Riset
        </option>

        <option value="Staf Transformasi Bisnis"
            <?php echo e(old('unit_kerja') == 'Staf Transformasi Bisnis' ? 'selected' : ''); ?>>
            Staf Transformasi Bisnis
        </option>

        <option value="Project Manager"
            <?php echo e(old('unit_kerja') == 'Project Manager' ? 'selected' : ''); ?>>
            Project Manager
        </option>
        <option value="Departemen keauangan & Anggaran"
            <?php echo e(old('unit_kerja') == 'Departemen keauangan & Anggaran' ? 'selected' : ''); ?>>
            Departemen keauangan & Anggaran
        </option>
         <option value="Departement Akutansi"
            <?php echo e(old('unit_kerja') == 'Departement Akutansi' ? 'selected' : ''); ?>>
            Departement Akutansi
        </option>
         <option value="Departement Administrasi Pemasaran & Penjualan"
            <?php echo e(old('unit_kerja') == 'Departement Administrasi Pemasaran & Penjualan' ? 'selected' : ''); ?>>
            Departement Administrasi Pemasaran & Penjualan
        </option>
           <option value="Departement Operasional SDM"
            <?php echo e(old('unit_kerja') == 'Departement Operasional SDM' ? 'selected' : ''); ?>>
            Departement Operasional SDM
        </option>
         <option value="Departement Manajemen & Pengembangan SDM"
            <?php echo e(old('unit_kerja') == 'Departement Manajemen & Pengembangan SDM' ? 'selected' : ''); ?>>
            Departement Manajemen & Pengembangan SDM
        </option>
           <option value="Departement Pelayanan Umum"
            <?php echo e(old('unit_kerja') == 'Departement Pelayanan Umum' ? 'selected' : ''); ?>>
            Departement Pelayanan Umum
        </option>
           <option value="Departement keamanan"
            <?php echo e(old('unit_kerja') == 'Departement keamanan' ? 'selected' : ''); ?>>
            Departement keamanan
        </option>
          <option value="Departemen Perencanaan, penerimaan, & pergudangan"
            <?php echo e(old('unit_kerja') == 'Departemen Perencanaan, penerimaan, & pergudangan' ? 'selected' : ''); ?>>
           Departemen Perencanaan, penerimaan, & pergudangan
        </option>
           <option value="Departemen Pengadaan barang & Jasa"
            <?php echo e(old('unit_kerja') == 'Departemen Pengadaan barang & Jasa' ? 'selected' : ''); ?>>
            Departemen Pengadaan barang & Jasa
        </option>
           <option value="Departemen Manajemen Resiko"
            <?php echo e(old('unit_kerja') == 'Departemen Manajemen Resiko' ? 'selected' : ''); ?>>
           Departemen Manajemen Resiko
        </option>
           <option value="Staf Tata Kelola & Kepatuhan"
            <?php echo e(old('unit_kerja') == 'Staf Tata Kelola & Kepatuhan' ? 'selected' : ''); ?>>
            Staf Tata Kelola & Kepatuhan
        </option>
           <option value="Departement Hukum"
            <?php echo e(old('unit_kerja') == 'Departement Hukum' ? 'selected' : ''); ?>>
            Departement Hukum
        </option>
           <option value="Departemen Operasi Pabrik -1"
            <?php echo e(old('unit_kerja') == 'Departemen Operasi Pabrik -1' ? 'selected' : ''); ?>>
           Departemen Operasi Pabrik -1
        </option>
           <option value="Departemen Operasi Pabrik-2"
            <?php echo e(old('unit_kerja') == 'Departemen Operasi Pabrik-2' ? 'selected' : ''); ?>>
           Departemen Operasi Pabrik-2
        </option>
          </option>
           <option value="Departemen Operasi Pabrik -3"
            <?php echo e(old('unit_kerja') == 'Departemen Operasi Pabrik -3' ? 'selected' : ''); ?>>
           Departemen Operasi Pabrik -3
        </option>
           <option value="Departemen Proses & Pengelola Energi"
            <?php echo e(old('unit_kerja') == 'Departemen Proses & Pengelola Energi' ? 'selected' : ''); ?>>
           Departemen Proses & Pengelola Energi
        </option>
             <option value="Departement Inspeksi Teknik & Kendala"
            <?php echo e(old('unit_kerja') == 'Departement Inspeksi Teknik & Kendala' ? 'selected' : ''); ?>>
           Departement Inspeksi Teknik & Kendala
        </option>
          </option>
           <option value="Departemen K3LH"
            <?php echo e(old('unit_kerja') == 'Departemen K3LH' ? 'selected' : ''); ?>>
           Departemen K3LH
        </option>
           <option value="Departemen Perencanaan Pengendalian Pemeliharaan"
            <?php echo e(old('unit_kerja') == 'Departemen Perencanaan Pengendalian Pemeliharaan' ? 'selected' : ''); ?>>
           Departemen Perencanaan Pengendalian Pemeliharaan
        </option>
              <option value="Departemen Pemeliharaan Mekanik, listrik & Instrumen"
            <?php echo e(old('unit_kerja') == 'Departemen Pemeliharaan Mekanik, listrik & Instrumen' ? 'selected' : ''); ?>>
          Departemen Pemeliharaan Mekanik, listrik & Instrumen
        </option>
          </option>
           <option value="Departemen Perbengkelan & Peralatan"
            <?php echo e(old('unit_kerja') == 'Departemen Perbengkelan & Peralatan' ? 'selected' : ''); ?>>
         Departemen Perbengkelan & Peralatan
        </option>
           <option value="Departemen Jasa Pelayan Pabrik"
            <?php echo e(old('unit_kerja') == 'Departemen Jasa Pelayan Pabrik' ? 'selected' : ''); ?>>
           Departemen Jasa Pelayan Pabrik
        </option>

               <option value="Spesialis"
            <?php echo e(old('unit_kerja') == 'Spesialis' ? 'selected' : ''); ?>>
          Spesialis
        </option>
          </option>
           <option value="Departement pengembangan Bisnis"
            <?php echo e(old('unit_kerja') == 'Departement pengembangan Bisnis' ? 'selected' : ''); ?>>
         Departement pengembangan Bisnis
        </option>
           <option value="Departement Rancang Bangun"
            <?php echo e(old('unit_kerja') == 'Departement Rancang Bangun' ? 'selected' : ''); ?>>
           Departement Rancang Bangun
        </option>
    </select>

    <small class="text-danger">
        <i class="fas me-1"></i>
        *Pilih unit kerja.
    </small>

    <?php $__errorArgs = ['unit_kerja'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="invalid-feedback" style="display:block">
        <?php echo e($message); ?>

    </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


        
        <div class="form-group mb-1">
            <label for="email" class="font-weight-bold"><i class="fas fa-envelope mr-1"></i> Email Team</label>
            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                value="<?php echo e(old('email')); ?>" required placeholder="Masukkan Email Team">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback" style="display:block">
                <?php echo e($message); ?>

            </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="form-group mb-1">
            <label for="password" class="font-weight-bold"><i class="fas fa-lock mr-1"></i> Password</label>
            <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                name="password" required placeholder="Masukkan Password">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback" style="display:block">
                <?php echo e($message); ?>

            </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="form-group mb-3">
            <label for="password_confirmation" class="font-weight-bold"><i class="fas fa-lock mr-1"></i> Konfirmasi
                Password</label>
            <input id="password_confirmation" type="password"
                class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password_confirmation"
                required placeholder="Konfirmasi Password">
            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback" style="display:block">
                <?php echo e($message); ?>

            </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <button type="submit" class="btn btn-primary btn-lg btn-block">
            <i class="fas fa-user-plus mr-1"></i> Register
        </button>
    </form>

    
    <div class="text-center mt-3">
        <a href="<?php echo e(route('login')); ?>" class="text-small text-primary">
            <i class="fas fa-sign-in-alt mr-1"></i> Sudah Punya Akun?
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- JS Libraries -->
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/auth/register.blade.php ENDPATH**/ ?>