<?php $__env->startSection('title', 'Tambah Pengumuman'); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card" style="max-width: 900px; margin: 0 auto;">
                        <div class="card-header">
                            <h4 class="m-0">Tambah Pengumuman</h4>
                        </div>

                        <div class="card-body">
                            <form action="<?php echo e(route('admin.pengumuman.store')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                
                                <div class="form-group mb-4">
                                    <label for="judul" class="form-label fw-bold">
                                        Judul Pengumuman
                                    </label>
                                    <input type="text"
                                           name="judul"
                                           id="judul"
                                           class="form-control <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           placeholder="Contoh: Pendaftaran Lomba Inovasi Mahasiswa 2026"
                                           value="<?php echo e(old('judul')); ?>"
                                           required>

                                    <small class="text-muted">
                                        Isi dengan judul singkat dan jelas.
                                    </small>

                                    <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="form-group mb-4">
                                    <label for="ringkasan" class="form-label fw-bold">
                                        Ringkasan
                                    </label>
                                    <textarea name="ringkasan"
                                              id="ringkasan"
                                              rows="2"
                                              class="form-control <?php $__errorArgs = ['ringkasan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                              placeholder="Tuliskan ringkasan singkat pengumuman (opsional)"><?php echo e(old('ringkasan')); ?></textarea>

                                    <small class="text-muted">
                                        Maksimal 1–2 kalimat untuk preview di halaman utama.
                                    </small>

                                    <?php $__errorArgs = ['ringkasan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="form-group mb-4">
                                    <label for="isi" class="form-label fw-bold">
                                        Isi Pengumuman
                                    </label>
                                    <textarea name="isi"
                                              id="isi"
                                              rows="6"
                                              class="form-control <?php $__errorArgs = ['isi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                              placeholder="Tuliskan isi lengkap pengumuman di sini..."
                                              required><?php echo e(old('isi')); ?></textarea>

                                    <small class="text-muted">
                                        Bisa berisi informasi detail, jadwal, ketentuan, dll.
                                    </small>

                                    <?php $__errorArgs = ['isi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="form-group mb-4">
                                    <label for="gambar" class="form-label fw-bold">
                                        Upload File / Gambar
                                    </label>
                                    <input type="file"
                                           name="gambar"
                                           id="gambar"
                                           class="form-control <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx">

                                    <small class="text-muted">
                                        Format: JPG, PNG, WEBP, PDF, DOC, DOCX (max 2MB)
                                    </small>

                                    <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="form-group mb-4">
                                    <label for="urutan" class="form-label fw-bold">
                                        Urutan Slide
                                    </label>
                                    <input type="number"
                                           name="urutan"
                                           id="urutan"
                                           class="form-control <?php $__errorArgs = ['urutan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                           value="<?php echo e(old('urutan', 0)); ?>"
                                           min="0">

                                    <small class="text-muted">
                                        Semakin kecil angka, semakin depan tampilannya.
                                    </small>

                                    <?php $__errorArgs = ['urutan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <hr>

                                <input type="hidden" name="is_active" value="0">
                                <div class="form-check form-switch mb-4">
                                    <input type="checkbox"
                                           name="is_active"
                                           value="1"
                                           class="form-check-input"
                                           <?php echo e(old('is_active', 1) ? 'checked' : ''); ?>>
                                    <label class="form-check-label">
                                        Aktifkan Pengumuman
                                    </label>
                                </div>

                                
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary px-5">
                                        Simpan Pengumuman
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/pengumuman/create.blade.php ENDPATH**/ ?>