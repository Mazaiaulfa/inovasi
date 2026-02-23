@extends('layouts.app')

@section('title', 'Rekap Data')

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
        /* supaya search tetap di kanan */
    }

    .dataTables_wrapper .dataTables_filter label {
        margin: 0;
        display: flex;
        align-items: center;
        gap: 5px;
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
                        <div class="card-header">
                            <h4>
                                Rekap Data Inovasi
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="rekapTable" class="table table-striped table-bordered table-hover w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Gugus</th>
                                            <th>Judul</th>
                                            <th>Tanggal Upload</th>
                                            <th>Status</th>
                                            <th>Anggota</th>
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
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(function() {
    let table = $('#rekapTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('admin.rekap.index') }}',
            type: 'GET'
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
            { data: 'status', name: 'status' },
            { data: 'anggota', name: 'anggota' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        initComplete: function() {
            //  handle button export to left
            let exportBtn = `
                <a href="{{ route('rekap.exportAll') }}"
                   class="btn btn-success btn-sm"
                   style="white-space: nowrap;">
                    <i class="fas fa-file-excel"></i> Export Semua
                </a>`;
            $("#rekapTable_filter").append(exportBtn);
        },

    });
});
</script>
@endpush
