<?php $__env->startSection('title', 'Verifikasi Judul'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Verifikasi Judul Makalah</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="verifikasi-table" class="table table-bordered table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Gugus</th>
                                            <th>Judul Makalah</th>
                                            <th>File Judul</th>
                                            <th>Catatan</th>
                                            <th>Status</th>
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

<!-- Modal Preview -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="verifikasi-form" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-content shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="modal-header bg-gradient  position-relative padding: 25px 30px;">
                    <h5 class="modal-title fw-bold d-flex align-items-center gap-2" id="previewLabel">
                        <i class="fas fa-file-alt"></i>
                        Detail Judul Makalah
                    </h5>
                    <button type="button" class="btn-close btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body" style="padding: 30px;">
                    <!-- Info Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card border-0 bg-light" style="border-radius: 15px;">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-user text-primary me-3" style="font-size: 1.2rem;"></i>
                                                <div>
                                                    <small class="text-muted">Nama Gugus</small>
                                                    <p class="mb-0 fw-semibold" id="modal-nama">-</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-book text-success me-3" style="font-size: 1.2rem;"></i>
                                                <div>
                                                    <small class="text-muted">Judul Makalah</small>
                                                    <p class="mb-0 fw-semibold" id="modal-judul">-</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                    <div class="col-12">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-pdf text-danger me-3" style="font-size: 1.2rem;"></i>
                                <div>
                                    <small class="text-muted">File Judul</small>
                                    <p class="mb-0 fw-semibold">
    <a id="modal-file" href="#" target="_blank" class="btn btn-sm btn-outline-primary">
    <i class="fas fa-file-pdf"></i> Lihat PDF
</a>


                                    </p>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>

                    <!-- Form Section -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold d-flex align-items-center gap-2">
                                <i class="fas fa-check-circle text-primary"></i>
                                Status Verifikasi
                            </label>
                            <select class="form-select" name="status_judul" required
                                style="border-radius: 10px; border: 2px solid #e5e7eb; padding: 12px 16px;">
                                <option value="">-- Pilih Status --</option>
                                <option value="pending">
                                    <i class="fas fa-clock"></i> Pending
                                </option>
                                <option value="disetujui">
                                    <i class="fas fa-check"></i> Disetujui
                                </option>
                                <option value="ditolak">
                                    <i class="fas fa-times"></i> Ditolak
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold d-flex align-items-center gap-2">
                                <i class="fas fa-sticky-note text-warning"></i>
                                Catatan
                                <small class="text-muted">(Opsional)</small>
                            </label>
                            <textarea name="catatan_judul" class="form-control" rows="3"
                                style="border-radius: 10px; border: 2px solid #e5e7eb; padding: 12px 16px; resize: vertical;"
                                placeholder="Tambahkan catatan verifikasi..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0" style="padding: 20px 30px; border-radius: 0 0 20px 20px;">
                    <button type="submit" class="btn btn-success fw-semibold px-4 py-2 d-flex align-items-center gap-2"
                        style="border-radius: 10px; border: none; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                        <i class="fas fa-save"></i>
                        Simpan Verifikasi
                    </button>
                    <button type="button"
                        class="btn btn-secondary fw-semibold px-4 py-2 d-flex align-items-center gap-2"
                        data-bs-dismiss="modal" style="border-radius: 10px; border: none;">
                        <i class="fas fa-times"></i>
                        Tutup
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="edit-form" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-content shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="modal-header bg-gradient position-relative padding: 25px 30px;">
                    <h5 class="modal-title fw-bold d-flex align-items-center gap-2" id="editLabel">
                        <i class="fas fa-edit"></i>
                        Edit Judul Makalah
                    </h5>
                    <button type="button" class="btn-close btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body" style="padding: 30px;">
                    <!-- Edit Form Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 bg-light" style="border-radius: 15px;">
                                <div class="card-body p-4">
                                    <div class="mb-4">
                                        <label for="edit-judul"
                                            class="form-label fw-semibold d-flex align-items-center gap-2 mb-3">
                                            <i class="fas fa-book-open text-primary"></i>
                                            Judul Makalah
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0"
                                                style="border-radius: 10px 0 0 10px; border: 2px solid #e5e7eb; border-right: none;">
                                                <i class="fas fa-pen text-muted"></i>
                                            </span>
                                            <input type="text" name="judul" class="form-control border-start-0"
                                                id="edit-judul" required
                                                style="border-radius: 0 10px 10px 0; border: 2px solid #e5e7eb; border-left: none; padding: 12px 16px;">
                                        </div>
                                        <div class="form-text mt-2" style="color: red;">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Pastikan judul yang dimasukkan sudah sesuai dan tidak mengandung kesalahan.
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold d-flex align-items-center gap-2">
                                            <i class="fas fa-check-circle text-primary"></i>
                                            Status Verifikasi
                                        </label>
                                        <select class="form-select" name="status_judul" required
                                            style="border-radius: 10px; border: 2px solid #e5e7eb; padding: 12px 16px;">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="pending">
                                                <i class="fas fa-clock"></i> Pending
                                            </option>
                                            <option value="disetujui">
                                                <i class="fas fa-check"></i> Disetujui
                                            </option>
                                            <option value="ditolak">
                                                <i class="fas fa-times"></i> Ditolak
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0" style="padding: 20px 30px; border-radius: 0 0 20px 20px;">
                    <button type="submit" class="btn btn-primary fw-semibold px-4 py-2 d-flex align-items-center gap-2"
                        style="border-radius: 10px; border: none; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    </button>
                    <button type="button"
                        class="btn btn-secondary fw-semibold px-4 py-2 d-flex align-items-center gap-2"
                        data-bs-dismiss="modal" style="border-radius: 10px; border: none;">
                        <i class="fas fa-times"></i>
                        Batal
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

<script>
$(document).ready(function () {

    // =========================
    // BASE URL (INI KUNCINYA)
    // =========================
    const baseUrl = '<?php echo e(url("/")); ?>';

    // Inisialisasi DataTable
    let table = $('#verifikasi-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: baseUrl + '/admin/verifikasi',
        columns: [
            { data: 'id', name: 'id', render: (data, type, row, meta) => meta.row + 1 },
            { data: 'user.name', name: 'user.name' },
            { data: 'judul', name: 'judul' },

            {
                data: 'file_ajukan',
                name: 'file_ajukan',
                render: function(data) {
                    if (!data) return '-';
                    return `
                        <a href="${data}" target="_blank"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-file-pdf"></i> Lihat PDF
                        </a>`;
                }
            },

            { data: 'catatan', name: 'catatan' },
            { data: 'status_judul', name: 'status_judul' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
        ]
    });

    // Inisialisasi modal
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));

    // =========================
    // PREVIEW
    // =========================
    $(document).on('click', '.btn-preview', function () {
        const fileUrl = $(this).data('file_ajukan');
        const id = $(this).data('id');

        $('#modal-nama').text($(this).data('nama'));
        $('#modal-judul').text($(this).data('judul'));

        if (fileUrl) {
            $('#modal-file').attr('href', fileUrl).text('Lihat PDF').show();
        } else {
            $('#modal-file').hide();
        }

        $('#verifikasi-form').attr('action', baseUrl + '/admin/verifikasi/' + id);
        $('#verifikasi-form select[name="status_judul"]').val($(this).data('status'));
        $('#verifikasi-form textarea[name="catatan_judul"]').val($(this).data('catatan'));

        previewModal.show();
    });

    // =========================
    // EDIT
    // =========================
    $(document).on('click', '.btn-edit', function () {
        const id = $(this).data('id');
        $('#edit-judul').val($(this).data('judul'));
        $('#edit-form select[name="status_judul"]').val($(this).data('status'));
        $('#edit-form').attr('action', baseUrl + '/admin/verifikasi/' + id);
        editModal.show();
    });

    // =========================
    // DELETE
    // =========================
    $(document).on('click', '.btn-delete', function () {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: baseUrl + '/admin/verifikasi/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function () {
                        Swal.fire('Berhasil!', 'Data telah dihapus.', 'success');
                        table.ajax.reload(null, false);
                    },
                    error: function () {
                        Swal.fire('Gagal!', 'Data memiliki relasi dan tidak dapat dihapus.', 'error');
                    }
                });
            }
        });
    });

    // =========================
    // SUBMIT VERIFIKASI
    // =========================
    $('#verifikasi-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            success: function() {
                previewModal.hide();
                Swal.fire('Berhasil!', 'Status berhasil diperbarui', 'success');
                table.ajax.reload(null, false);
            },
            error: function() {
                Swal.fire('Gagal!', 'Terjadi kesalahan saat memperbarui status', 'error');
            }
        });
    });

    // =========================
    // SUBMIT EDIT
    // =========================
    $('#edit-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            success: function() {
                editModal.hide();
                Swal.fire('Berhasil!', 'Judul berhasil diperbarui', 'success');
                table.ajax.reload(null, false);
            },
            error: function() {
                Swal.fire('Gagal!', 'Terjadi kesalahan saat memperbarui judul', 'error');
            }
        });
    });

    // Reset form saat modal ditutup
    $('#previewModal, #editModal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
    });

});
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/verifikasi/index.blade.php ENDPATH**/ ?>