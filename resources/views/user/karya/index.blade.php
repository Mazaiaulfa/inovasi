@extends('layouts.app')
@section('title', 'Pengajuan Judul')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endpush

@section('main')
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Pengajuan Judul</h4>
                            <a href="{{ route('karya.create') }}" class="btn btn-primary">Ajukan Judul</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="karya-table" class="table table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>File Ajukan</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {

        // Base URL untuk storage
        const storageUrl = "{{ asset('storage') }}";

        $('#karya-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('karya.index') }}',
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'judul', name: 'judul' },

                // Kolom file PDF
                {
                    data: 'file_ajukan',
                    name: 'file_ajukan',
                    orderable: false,
                    searchable: false,
                 
                        render: function(url) {
        if (url) {
            return `
                <a href="${url}" target="_blank" class="btn btn-sm btn-danger">
                    Lihat PDF
                </a>
            `;
        }
        return `<span class="text-muted">Tidak ada</span>`;
                    }
                },

                // Kolom status
                {
                    data: 'status_judul',
                    name: 'status_judul',
                    render: function(data) {
                        let badgeClass = 'bg-primary';
                        if (data === 'pending') badgeClass = 'bg-warning';
                        else if (data === 'disetujui') badgeClass = 'bg-success';
                        else if (data === 'ditolak') badgeClass = 'bg-danger';

                        return `<div class="text-center">
                                    <span class="badge ${badgeClass} rounded-pill text-white text-uppercase">
                                        ${data}
                                    </span>
                                </div>`;
                    }
                },

                { data: 'catatan', name: 'catatan' },

                // Kolom aksi
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // SweetAlert untuk hapus
        $(document).on('click', '.action-delete', function(e) {
            e.preventDefault();
            const actionUrl = $(this).data('action');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data pengajuan judul akan dihapus permanen.",
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

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}'
        });
        @endif
    });
</script>
@endpush
