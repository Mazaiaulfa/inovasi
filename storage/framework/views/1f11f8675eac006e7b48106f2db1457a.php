<?php $__env->startSection('title', 'Gugus'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

<style>
   .modern-tabs {
    border-bottom: 1px solid #e5e7eb;
    margin: 10px 20px 0 20px; /* 🔥 kasih jarak kiri kanan */
    padding-bottom: 5px;
}

.tab-item {
    padding: 10px 12px; /* 🔥 tambah lebar klik */
    margin-right: 10px; /* 🔥 jarak antar tab */
    cursor: pointer;
    color: #6b7280;
    font-weight: 500;
    position: relative;
    transition: all 0.25s ease;
    border-radius: 6px; /* opsional biar lebih modern */
}

.tab-item:hover {
    color: #6366f1;
}

.tab-item.active {
    color: #6366f1;
}

.tab-item.active::after {
    content: "";
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 3px;
    background: #6366f1;
    border-radius: 3px 3px 0 0;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="m-0">List Gugus</h3>
                            <a href="<?php echo e(route('user.create')); ?>" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus mr-1"></i> Tambah Gugus
                            </a>
                        </div>
                        <div class="mb-3">
    <div class="modern-tabs d-flex gap-4">
        <div class="tab-item active" data-filter="all">
            <i class="fas fa-layer-group me-2"></i> Semua
        </div>
        <div class="tab-item" data-filter="EIF">
            <i class="fas fa-user me-2"></i> EIF
        </div>
        <div class="tab-item" data-filter="GKM">
            <i class="fas fa-users me-2"></i> GKM
        </div>
        <div class="tab-item" data-filter="SS">
            <i class="fas fa-lightbulb me-2"></i> SS
        </div>
    </div>
</div>
                        <div class="card-body">
                            <table id="user-table" class="table table-bordered table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Gugus</th>
                                        <th>Direktorat</th>
                                        <th>Kompartemen</th>
                                        <th>Unit Kerja</th>
                                        <th>Email</th>
                                        <th>Role</th>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {

    let jenisFilter = 'all';

    let table = $('#user-table').DataTable({
        processing: false,
        serverSide: true,
        responsive: true,
        ajax: {
            url: '<?php echo e(route('user.index')); ?>',
            data: function (d) {
                d.jenis = jenisFilter;
            }
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'name', name: 'name' },
            { data: 'direktorat', name: 'direktorat' },
            { data: 'kompartemen', name: 'kompartemen' },
            { data: 'unit_kerja', name: 'unit_kerja' },
            { data: 'email', name: 'email' },
            { data: 'role', name: 'role' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // ✅ FILTER TAB (PINDAH KE SINI)
    $('.tab-item').on('click', function () {
        $('.tab-item').removeClass('active');
        $(this).addClass('active');

        jenisFilter = $(this).data('filter');
        table.ajax.reload(null, false);
    });

    // SweetAlert Delete
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data user akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/user/index.blade.php ENDPATH**/ ?>