
<?php $__env->startSection('title', 'Final Karya'); ?>

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
                    <!-- Form Upload -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Upload Final Karya</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('finalkarya.store')); ?>" method="POST" enctype="multipart/form-data"
                                class="mb-4">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="karya_id">Judul Karya</label>
                                    <select name="karya_id" class="form-control" required>
                                        <option value="" disabled selected>Pilih judul ...</option>
                                        <?php $__currentLoopData = Auth::user()->karyaTulis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $karya): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($karya->id); ?>"><?php echo e($karya->judul); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="file">File Final (PDF)</label>
                                    <input type="file" name="file" class="form-control" accept="application/pdf"
                                        required>
                                </div>
                                <button class="btn btn-primary mt-3">Upload</button>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>Daftar Final</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="final-table" class="table table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>File</th>
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

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="edit-form" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit File Final Karya</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Judul:</strong> <span id="edit-judul"></span></p>
                    <div class="form-group">
                        <label for="edit-file">Upload Ulang File (PDF)</label>
                        <input type="file" name="file" class="form-control" accept="application/pdf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Update</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function() {
            const table = $('#final-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?php echo e(route('finalkarya.index')); ?>',
                columns: [{
                        data: 'id',
                        render: (data, type, row, meta) => meta.row + 1
                    },
                    {
                        data: 'judul'
                    },
                    {
                        data: 'file'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'aksi'
                    }
                ]
            });

            // Buka modal edit
            $(document).on('click', '.btn-edit', function() {
                const id = $(this).data('id');
                const judul = $(this).data('judul');
                $('#edit-judul').text(judul);
                $('#edit-form').attr('action', `/finalkarya/${id}`);
                $('#editModal').modal('show');
            });

            // btn DELETE
            $(document).on('click', '.btn-delete', function() {
                var url = $(this).data('url');
                var judul = $(this).data('judul');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: `Final karya "${judul}" akan dihapus permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                _method: 'DELETE'
                            },
                            success: function(res) {
                                Swal.fire('Berhasil', 'File berhasil dihapus!',
                                    'success');
                                $('#final-table').DataTable().ajax
                            .reload(); // reload data
                            },
                            error: function(xhr) {
                                Swal.fire('Gagal',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error');
                            }
                        });
                    }
                });
            });

            // Pesan sukses
            <?php if(session('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '<?php echo e(session('success')); ?>'
                });
            <?php endif; ?>
        });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/user/final_karya/index.blade.php ENDPATH**/ ?>