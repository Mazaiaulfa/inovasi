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
    <label class="font-weight-bold">
        <i class="fas fa-layer-group mr-1"></i> Jenis Peserta
    </label>
    <select name="jenis_peserta" id="jenisPeserta"
        class="form-control <?php $__errorArgs = ['jenis_peserta'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
        <option value="">-- Pilih Jenis Peserta --</option>
                <option value="EIF" <?php echo e(old('jenis_peserta') == 'EIF' ? 'selected' : ''); ?>>
            EIF (Individu)
        </option>
        <option value="GKM" <?php echo e(old('jenis_peserta') == 'GKM' ? 'selected' : ''); ?>>
            GKM (Team)
        </option>
        <option value="SS" <?php echo e(old('jenis_peserta') == 'SS' ? 'selected' : ''); ?>>
            SS (Suggestion System)
        </option>
    </select>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['jenis_peserta'];
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
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

        
<div class="form-group mb-1">
    <label id="labelName" for="name" class="font-weight-bold">
        <i class="fas fa-users mr-1"></i> Nama Team
    </label>

    <input id="name"
        type="text"
        class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        name="name"
        value="<?php echo e(old('name')); ?>"
        required
        placeholder="Masukkan Nama Team">

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
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
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<div class="form-group mb-1">
    <label class="font-weight-bold">
        <i class="fas fa-building mr-1"></i> Direktorat
    </label>
    <select id="direktorat" name="direktorat"
        class="form-control <?php $__errorArgs = ['direktorat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
        <option value="">-- Pilih Direktorat --</option>
    </select>
</div>

<div class="form-group mb-1">
    <label class="font-weight-bold">
        <i class="fas fa-sitemap mr-1"></i> Kompartemen
    </label>
    <select id="kompartemen" name="kompartemen"
        class="form-control <?php $__errorArgs = ['kompartemen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
        <option value="">-- Pilih Kompartemen --</option>
    </select>
</div>

<div class="form-group mb-1">
    <label for="unitKerja" class="font-weight-bold">
        <i class="fas fa-building mr-1"></i> Unit Kerja
    </label>
    <select id="unitKerja"
        name="unit_kerja"
        class="form-control <?php $__errorArgs = ['unit_kerja'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        required>
        <option value="">-- Pilih Unit Kerja --</option>
    </select>

    <small class="text-danger">
        <i class="fas me-1"></i>
        *Pilih unit kerja.
    </small>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['unit_kerja'];
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
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
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
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
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
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password_confirmation'];
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
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
<script>
document.addEventListener("DOMContentLoaded", function () {

    const jenis = document.getElementById("jenisPeserta");
    const label = document.getElementById("labelName");
    const input = document.getElementById("name");

   function ubahLabel() {

    if (jenis.value === "EIF") {
        label.innerHTML = '<i class="fas fa-user mr-1"></i> Nama Peserta';
        input.placeholder = "Masukkan Nama Peserta";

    } else if (jenis.value === "GKM") {
        label.innerHTML = '<i class="fas fa-users mr-1"></i> Nama Team';
        input.placeholder = "Masukkan Nama Team";

    } else if (jenis.value === "SS") {
        label.innerHTML = '<i class="fas fa-lightbulb mr-1"></i> Nama Pengusul';
        input.placeholder = "Masukkan Nama Pengusul";
    }
    }

    jenis.addEventListener("change", ubahLabel);

    ubahLabel(); // supaya tetap sesuai kalau reload
});
</script>
<script>
// DATA HIERARKI
const dataUnit = {
"Direktorat Utama": {
    "Sekretaris Perusahaan": [
        "Dept. Komunikasi & ADM Korporat",
        "Dept. TJSL"
    ],
    "Satuan Pengawasan Intern": [
        "Dept. Pengawasan",
        "Dept. QA, Konsultasi, Perencanaan & Pemantauan"
    ]
},
"Direktorat Operasi & Produksi": {
    "Komp. Operasi": [
        "Dept. Operasi Pabrik-1",
        "Dept. Operasi Pabrik 2",
        "Dept. Operasi Pabrik-3"
    ],
    "Komp. Pemeliharaan": [
        "Dept. Perencanaan Pengendalian & Pemeliharaan",
        "Dept. Pemeliharaan Mekanik, Listrik & Instrument",
        "Dept. Perbengkelan dan Peralatan",
        "Dept. Jasa Pelayanan Pabrik"
    ],
    "Komp. Teknologi & K3LH": [
        "Dept. Proses & Pengelolaan Energi",
        "Dept. Inspeksi Teknik & Keandalan",
        "Dept. K3 & LH",
        "Dept. Teknologi Informasi PIM"
    ],
    "Komp. Teknik & Pengembangan": [
        "Dept. Pengembangan Bisnis",
        "Dept. Rancang Bangun"
    ]
},
"Direktorat Keuangan & Umum": {
    "Komp. Manajemen Keuangan": [
        "Dept. Keuangan & Pajak",
        "Dept. Anggaran & Kinerja Korporat",
        "Dept. Akuntansi",
        "Dept. Administrasi Pemasaran & Penjualan",
        "Dept. Pengelolaan Pelanggan"
    ],
    "Komp. Sumber Daya Manusia": [
        "Dept. Operasional SDM",
        "Dept. Manajemen & Pengembangan SDM",
        "Dept. Sistem Manajemen Terpadu & Inovasi"
    ],
    "Komp. Manajemen Logistik & Umum": [
        "Dept. Pelayanan Umum",
        "Dept. Keamanan",
        "Dept. Perencanaan, Penerimaan & Pergudangan",
        "Dept. Pengadaan Barang & Jasa"
    ]
},
"Direktorat Manajemen Risiko": {
    "Komp. Tata Kelola & Manajemen Risiko": [
        "Dept. Manajemen Risiko",
        "Dept. Hukum"
    ]
}
};

// ELEMENT
const direktorat = document.getElementById("direktorat");
const kompartemen = document.getElementById("kompartemen");
const unitKerja = document.getElementById("unitKerja");

// LOAD DIREKTORAT
Object.keys(dataUnit).forEach(dir => {
    direktorat.add(new Option(dir, dir));
});

// ON CHANGE DIREKTORAT
direktorat.addEventListener("change", function () {
    kompartemen.innerHTML = '<option value="">-- Pilih Kompartemen --</option>';
    unitKerja.innerHTML = '<option value="">-- Pilih Unit Kerja --</option>';

    if (this.value) {
        Object.keys(dataUnit[this.value]).forEach(k => {
            kompartemen.add(new Option(k, k));
        });
    }
});

// ON CHANGE KOMPARTEMEN
kompartemen.addEventListener("change", function () {
    unitKerja.innerHTML = '<option value="">-- Pilih Unit Kerja --</option>';

    if (this.value) {
        dataUnit[direktorat.value][this.value].forEach(u => {
            unitKerja.add(new Option(u, u));
        });
    }
});
</script>
<?php $__env->stopPush(); ?>





<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/auth/register.blade.php ENDPATH**/ ?>