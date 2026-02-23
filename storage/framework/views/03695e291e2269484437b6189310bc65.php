<?php $__env->startSection('title', 'Kelola Anggota'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Kelola Anggota</h4>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#anggotaModal"
                                id="btnTambah">
                                Tambah Anggota
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="anggotaTable" class="table table-bordered table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Gugus</th>
                                            <th>Nama Anggota</th>
                                             <th>No Badge</th>
                                            <th>Jabatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit -->
<div class="modal fade" id="anggotaModal" tabindex="-1" aria-labelledby="anggotaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formAnggota">
            <?php echo csrf_field(); ?>
            <input type="hidden" id="anggota_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="anggotaModalLabel">Tambah Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_id">Nama Gugus</label>
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="">Pilih Gugus</option>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback" id="user_id-error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="nama">Nama Anggota</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                        <div class="invalid-feedback" id="nama-error"></div>
                    </div>
                    <div class="mb-3">
                    <label for="badge">No Badge</label>
                    <input type="text" name="badge" id="badge" class="form-control">
                    <div class="invalid-feedback" id="badge-error"></div>
                </div>
                    <div class="mb-3">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-select">
                            <option value="">Pilih Jabatan...</option>
                            <option value="ketua">Ketua</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="fasilitator">Fasilitator</option>
                            <option value="anggota">Anggota</option>
                        </select>
                        <div class="invalid-feedback" id="jabatan-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {

        // 🔑 BASE URL (penting untuk hosting /inovasipim)
        const baseUrl = '<?php echo e(url("/")); ?>';

        // Initialize DataTable
        var table = $('#anggotaTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(route('admin.anggota.index')); ?>',
                type: 'GET',
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'user.name', name: 'user.name' },
                { data: 'nama', name: 'nama' },
                { data: 'badge', name: 'badge' },
                { data: 'jabatan', name: 'jabatan' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });

        // Reset form when adding new
        $('#btnTambah').on('click', function() {
            $('#anggota_id').val('');
            $('#formAnggota')[0].reset();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#anggotaModalLabel').text('Tambah Anggota');
        });

        // Form submission (Tambah & Edit)
        $('#formAnggota').submit(function(e) {
            e.preventDefault();

            let id = $('#anggota_id').val();
            let method = id ? 'PUT' : 'POST';

            // ✅ FIX URL
            let url = id
                ? baseUrl + `/admin/anggota/${id}`
                : '<?php echo e(route("admin.anggota.store")); ?>';

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            $.ajax({
                url: url,
                method: method,
                data: $(this).serialize(),
                success: function(response) {
                    $('#anggotaModal').modal('hide');
                    table.ajax.reload(null, false);
                    Swal.fire('Berhasil', response.message, 'success');
                },
               error: function(xhr) {
    if (xhr.status === 422) {

        let response = xhr.responseJSON;

        // ✅ Jika ada validasi biasa (field error)
        if (response.errors) {
            $.each(response.errors, function(key, val) {
                $('#' + key).addClass('is-invalid');
                $('#' + key + '-error').text(val[0]);
            });
        }
        // ✅ Jika error custom seperti "Ketua sudah ada"
        else if (response.message) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: response.message
            });
        }

    } else {
        Swal.fire('Gagal', 'Terjadi kesalahan server', 'error');
    }
}
            });
        });

        // Edit button
        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');

            // ✅ FIX URL
            $.get(baseUrl + `/admin/anggota/${id}`, function(response) {
                $('#anggotaModal').modal('show');
                $('#anggota_id').val(response.data.id);
                $('#nama').val(response.data.nama);
                $('#badge').val(response.data.badge);
                $('#jabatan').val(response.data.jabatan);
                $('#user_id').val(response.data.user_id);
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                $('#anggotaModalLabel').text('Edit Anggota');
            }).fail(function() {
                Swal.fire('Gagal', 'Data tidak ditemukan', 'error');
            });
        });

        // Delete button
        $(document).on('click', '.delete-btn', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Yakin ingin hapus?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: baseUrl + `/admin/anggota/${id}`, // ✅ FIX URL
                        method: 'DELETE',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>'
                        },
                        success: function(response) {
                            table.ajax.reload(null, false);
                            Swal.fire('Berhasil', response.message, 'success');
                        },
                        error: function(xhr) {
                            Swal.fire('Gagal', xhr.responseJSON.message || 'Terjadi kesalahan', 'error');
                        }
                    });
                }
            });
        });

    });
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/anggota/index.blade.php ENDPATH**/ ?>