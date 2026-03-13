@extends('layouts.app')

@section('title', 'History Inovasi')

@push('style')
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
.modern-tabs {
    border-bottom: 1px solid #e5e7eb;
}

.tab-item {
    padding: 10px 5px;
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
}
</style>
@endpush


@section('main')
<div class="main-content">
<div class="container-fluid">
<div class="section-body">

<div class="row">
<div class="col-12">

<div class="card">

<div class="card-header d-flex justify-content-between align-items-center">
<h4>History Data Inovasi</h4>


<a href="{{ route('rekap.exportAll') }}" id="btnExport" class="btn btn-success btn-sm">
<i class="fas fa-file-excel"></i> Export Excel
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
@endsection



@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>

let jenisFilter = 'all';

$(function() {

let table = $('#historyTable').DataTable({

processing: true,
serverSide: true,

ajax: {
    url: '{{ route('admin.history.index') }}',
    type: 'GET',
    data: function(d){
        d.tahun = $('#filterTahun').val();
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

{ data: 'judul', name: 'judul' },

{ data: 'tanggal_upload', name: 'tanggal_upload' },

{ data: 'ketua', name: 'ketua', orderable: false, searchable: false },

{ data: 'fasilitator', name: 'fasilitator', orderable: false, searchable: false },

{ data: 'anggota_lain', name: 'anggota_lain', orderable: false, searchable: false },

{
data: 'aksi',
name: 'aksi',
orderable: false,
searchable: false
}

],

order: [[3, 'desc']]

});


/* FILTER TAHUN */

$('.dataTables_filter').prepend(`

<select id="filterTahun" class="form-select form-select-sm me-2" style="width:120px;">
<option value="">Semua Tahun</option>

@for($i=date('Y'); $i>=2020; $i--)
<option value="{{ $i }}">{{ $i }}</option>
@endfor

</select>

`);

$(document).on('change','#filterTahun',function(){
table.ajax.reload();
updateExportLink();
});


/* FILTER TAB EIF GKM SS */

$('.tab-item').on('click', function () {

$('.tab-item').removeClass('active');
$(this).addClass('active');

jenisFilter = $(this).data('filter');

table.ajax.reload();

updateExportLink(); // tambahkan ini

});

}); // akhir $(function())

function updateExportLink(){

let tahun = $('#filterTahun').val();
let jenis = jenisFilter;

let url = "{{ route('rekap.exportAll') }}";

let params = [];

if(tahun){
params.push("tahun=" + tahun);
}

if(jenis && jenis !== 'all'){
params.push("jenis=" + jenis);
}

if(params.length){
url += "?" + params.join("&");
}

$('#btnExport').attr('href', url);

}
</script>

@endpush
