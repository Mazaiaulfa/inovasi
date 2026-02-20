@extends('layouts.app')
@section('title', 'Gugus')

@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
@endpush

@section('main')
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="m-0">List Gugus</h3>
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-lg">Tambah Gugus</a>
                        </div>
                        <div class="card-body">
                            <table id="user-table" class="table table-bordered table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Gugus</th>
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
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('user.index') }}',
            columns: [
                {   data: 'id',
                    name: 'id',
                     render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'name', name: 'name' },
                { data: 'unit_kerja', name: 'unit_kerja' },
                { data: 'email', name: 'email' },
                { data: 'role', name: 'role' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Konfirmasi hapus dengan SweetAlert
        $(document).on('click', '.action-delete', function(e) {
            e.preventDefault();
            const actionUrl = $(this).data('action');

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
                    const form = $('<form>', {
                        action: actionUrl,
                        method: 'POST'
                    }).append('@csrf', '@method("DELETE")').appendTo('body');

                    form.submit();
                }
            });
        });
    });
</script>
@endpush