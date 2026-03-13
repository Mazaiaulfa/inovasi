<?php $__env->startSection('title', 'History Inovasi'); ?>

<?php $__env->startPush('style'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<style>

/* Flex container untuk search + export */
.dataTables_wrapper .dataTables_filter {
    display: flex !important;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    flex-direction: row-reverse;
}

.dataTables_wrapper .dataTables_filter label {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Tabel rapi */
#historyTable td, #historyTable th {
    vertical-align: middle;
    white-space: nowrap;
}

/* Hanya kolom Judul boleh wrap */
#historyTable td:nth-child(3),
#historyTable th:nth-child(3) {
    white-space: normal;
    word-break: break-word;
    min-width: 350px;
    max-width: 450px;
}

/* Kolom anggota */
#historyTable .anggota-cell span {
    display: inline-block;
    margin-right: 10px;
    margin-bottom: 3px;
}

.badge-small {
    font-size: 0.7rem;
}

/* Scroll horizontal */
.table-responsive {
    overflow-x: auto;
}

/* Hover */
#historyTable tbody tr:hover {
    background-color: #f2f2f2;
    cursor: pointer;
}
.dataTables_filter select{
height:31px;
font-size:13px;
border-radius:5px;
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
<h4>History Data Inovasi</h4>


<a href="<?php echo e(route('rekap.exportAll')); ?>" id="btnExport" class="btn btn-success btn-sm">
<i class="fas fa-file-excel"></i> Export Excel
</a>

</div>
<div class="card-body">

<div class="table-responsive">

<table id="historyTable" class="table table-striped table-bordered table-hover w-100">

<thead class="table-light">

<tr>
<th>No</th>
<th>Nama Gugus</th>
<th>Judul</th>
<th>Tanggal Upload</th>
<th>Ketua</th>
<th>Fasilitator</th>
<th>Anggota Lain</th>
<th width="90">Aksi</th>
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
<?php $__env->stopSection(); ?>



<?php $__env->startPush('scripts'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>

$(function() {

let table = $('#historyTable').DataTable({

processing: true,
serverSide: true,

ajax: {
    url: '<?php echo e(route('admin.history.index')); ?>',
    type: 'GET',
    data: function(d){
        d.tahun = $('#filterTahun').val();
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

{ data: 'judul', name: 'judul' },

{ data: 'tanggal_upload', name: 'tanggal_upload' },

{ data: 'ketua', name: 'ketua', orderable: false, searchable: false, className: 'anggota-cell' },

{ data: 'fasilitator', name: 'fasilitator', orderable: false, searchable: false, className: 'anggota-cell' },

{ data: 'anggota_lain', name: 'anggota_lain', orderable: false, searchable: false, className: 'anggota-cell' },

{
data: 'aksi',
name: 'aksi',
orderable: false,
searchable: false
}

],

order: [[3, 'desc']]

})

/* Tambahkan filter tahun setelah DataTables muncul */

$('.dataTables_filter').prepend(`

<select id="filterTahun" class="form-select form-select-sm me-2" style="width:120px;">

<option value="">Semua Tahun</option>

<?php for($i=date('Y'); $i>=2020; $i--): ?>
<option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
<?php endfor; ?>

</select>

`)

/* reload saat filter berubah */

$(document).on('change','#filterTahun',function(){

table.ajax.reload()

updateExportLink()

})

})

function updateExportLink(){
    let tahun = $('#filterTahun').val();

    let url = "<?php echo e(route('rekap.exportAll')); ?>";

    if(tahun){
        url += "?tahun=" + tahun;
    }

    $('#btnExport').attr('href', url);
}
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\inovasirev\resources\views/admin/rekap/history.blade.php ENDPATH**/ ?>