<?php $__env->startSection('title', 'Verifikasi Final Karya'); ?>

<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.modern-tabs {
    border-bottom: 1px solid #e5e7eb;
}
.tab-item {
    padding: 12px 5px;
    cursor: pointer;
    color: #6b7280;
    font-weight: 500;
    position: relative;
    transition: all 0.25s ease;
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
<div class="card-header">
    <h4>Verifikasi Final Karya</h4>
</div>

<!-- FILTER TAB -->
<div class="mb-4 px-4 pt-3">
    <div class="modern-tabs d-flex gap-4">
        <div class="tab-item active" data-filter="all">Semua</div>
        <div class="tab-item" data-filter="EIF">EIF</div>
        <div class="tab-item" data-filter="GKM">GKM</div>
    </div>
</div>

<div class="card-body">
<table id="finalTable" class="table table-bordered table-striped w-100">
<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>Jenis Peserta</th>
<th>Judul</th>
<th>File</th>
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

<!-- MODAL VERIFIKASI -->
<div class="modal fade" id="verifModal" tabindex="-1">
<div class="modal-dialog modal-lg">
<form method="POST" id="formVerifikasi">
<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Verifikasi Final Karya</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
<p><strong>Nama: <span id="namaUser"></span></strong></p>
<p><strong>Judul: <span id="judulKarya"></span></strong></p>

<div class="mb-3">
<label>Status *</label>
<select name="status" id="status" class="form-select" required>
<option value="">-- Pilih --</option>
<option value="pending">Pending</option>
<option value="disetujui">Disetujui</option>
<option value="ditolak">Ditolak</option>
</select>
</div>

<div class="mb-3">
<label>Catatan</label>
<textarea name="catatan" id="catatan" class="form-control"></textarea>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
<button type="submit" class="btn btn-success">Simpan</button>
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
$(function () {

let jenisFilter = 'all';

const table = $('#finalTable').DataTable({
processing: true,
serverSide: true,
responsive: true,
ajax: {
    url: "<?php echo e(route('admin.final.index')); ?>",
    data: function(d){
        d.jenis = jenisFilter;
    }
},
columns: [
    { data: 'DT_RowIndex', orderable:false, searchable:false },
    { data: 'nama' },
    { data: 'jenis_peserta' },
    { data: 'judul' },
    { data: 'file', orderable:false, searchable:false },
    { data: 'catatan' },
    {
        data: 'status',
        render: function(data){
            const badge = {
                pending: 'warning',
                disetujui: 'success',
                ditolak: 'danger'
            }[data] || 'secondary';
            return `<span class="badge bg-${badge}">${data}</span>`;
        }
    },
    { data: 'aksi', orderable:false, searchable:false }
]
});

/* FILTER TAB */
$('.tab-item').on('click', function(){
    $('.tab-item').removeClass('active');
    $(this).addClass('active');
    jenisFilter = $(this).data('filter');
    table.ajax.reload(null,false);
});

/* VERIFIKASI */
$('#finalTable').on('click','.btn-verif',function(){
    const btn = $(this);

    $('#namaUser').text(btn.data('nama'));
    $('#judulKarya').text(btn.data('judul'));
    $('#status').val(btn.data('status'));
    $('#catatan').val(btn.data('catatan'));

    $('#formVerifikasi').attr('action', btn.data('url'));
    $('#verifModal').modal('show');
});

$('#formVerifikasi').submit(function(e){
e.preventDefault();
let form = $(this);

$.ajax({
    url: form.attr('action'),
    type:'POST',
    data: form.serialize(),
    success:function(){
        $('#verifModal').modal('hide');
        table.ajax.reload(null,false);
        Swal.fire('Berhasil','Status diperbarui','success');
    },
    error:function(){
        Swal.fire('Gagal','Terjadi kesalahan','error');
    }
});
});

/* DELETE */
$('#finalTable').on('click','.btn-delete',function(){
const url = $(this).data('url');

Swal.fire({
title:'Yakin?',
text:'Data tidak bisa dikembalikan!',
icon:'warning',
showCancelButton:true,
confirmButtonColor:'#d33'
}).then(result=>{
if(result.isConfirmed){
    $.ajax({
        url:url,
        type:'DELETE',
        data:{ _token:"<?php echo e(csrf_token()); ?>" },
        success:function(){
            table.ajax.reload(null,false);
            Swal.fire('Berhasil','Data dihapus','success');
        }
    });
}
});
});

});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/final/index.blade.php ENDPATH**/ ?>