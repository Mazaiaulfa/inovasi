@extends('layouts.app')
@section('title', 'Verifikasi Makalah')

@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* Flex container untuk search + filter */
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

    .dataTables_wrapper .dataTables_filter select {
        height: calc(1.5em + .75rem + 2px);
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
                            <h4>Verifikasi Makalah</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="proposalTable" class="table table-striped table-bordered table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Makalah</th>
                                            <th>Nama Gugus</th>
                                            <th>Tahapan</th>
                                            <th>File</th>
                                            <th>Catatan</th>
                                            <th>Waktu Upload</th>
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

<!-- Modal Verifikasi -->
<div class="modal fade" id="verifModal" tabindex="-1" aria-labelledby="verifModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="formVerifikasi">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifModalLabel">Verifikasi Makalah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama:</strong> <span id="namaUser"></span></p>
                    <p><strong>Judul:</strong> <span id="judulKarya"></span></p>
                    <div class="form-group mb-2">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="pending">Pending</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="formEdit" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header text-dark">
                    <h5 class="modal-title" id="editModalLabel">
                        <i class="fas fa-edit"></i> Edit Makalah
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="editTahapan" class="form-label">
                                    <i class="fas fa-layer-group"></i> Tahapan <span class="text-danger">*</span>
                                </label>
                                <select name="tahap_id" class="form-select" id="editTahapan" required>
                                    <option value="">Pilih Tahapan</option>
                                    @foreach($tahapan as $t)
                                    <option value="{{ $t->id }}">{{ $t->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="file_path" class="form-label">
                                    <i class="fas fa-file-pdf"></i> File Makalah (PDF)
                                </label>
                                <input type="file" name="file_path" class="form-control" accept=".pdf">
                                <small class="form-text text-muted">Maksimal 10MB. Kosongkan jika tidak ingin mengubah
                                    file.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="editStatus" class="form-label">
                                    <i class="fas fa-info-circle"></i> Status <span class="text-danger">*</span>
                                </label>
                                <select name="status" class="form-select" id="editStatus" required>
                                    <option value="pending">Pending</option>
                                    <option value="disetujui">Disetujui</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="border rounded p-3" style="background-color: #f8f9fa;">
                                <i class="fas fa-info-circle text-muted"></i>
                                <strong>File saat ini:</strong>
                                <a href="#" id="linkCurrentFile" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt"></i> Lihat File Saat Ini
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Makalah
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(function () {

    let table = $('#proposalTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: '{{ route('admin.proposal.index') }}',
            data: function (d) {
                d.status = $('#filter-status').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'judul' },
            { data: 'nama' },
            { data: 'tahapan' },
            { data: 'file', orderable: false, searchable: false },
            { data: 'catatan' },
            { data: 'waktu_upload' },
            {
                data: 'status',
                render: function (data) {
                    let color = {
                        pending: 'warning',
                        disetujui: 'success',
                        ditolak: 'danger'
                    }[data] ?? 'secondary';

                    return `<span class="badge bg-${color} text-capitalize">${data}</span>`;
                }
            },
            { data: 'aksi', orderable: false, searchable: false }
        ],
        initComplete: function () {
            let filterHtml = `
                <label class="ms-2">
                    Filter:
                    <select id="filter-status" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        <option value="pending">Pending</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </label>
            `;
            $('#proposalTable_filter').append(filterHtml);

            $('#filter-status').on('change', function () {
                table.ajax.reload();
            });
        }
    });

    /* =======================
       VERIFIKASI (OPEN MODAL)
    ======================== */
    $('#proposalTable').on('click', '.btn-preview', function () {
        $('#verifModal').modal('show');

        $('#namaUser').text($(this).data('nama'));
        $('#judulKarya').text($(this).data('judul'));

        let actionUrl = `{{ route('admin.proposal.verifikasi', ':id') }}`
            .replace(':id', $(this).data('id'));

        $('#formVerifikasi').attr('action', actionUrl);
        $('#formVerifikasi select[name="status"]').val($(this).data('status'));
        $('#formVerifikasi textarea[name="catatan"]').val($(this).data('catatan'));
    });

    /* ==================================================
       >>> TAMBAHAN FIX UTAMA (AJAX SUBMIT VERIFIKASI) <<<
       JANGAN HAPUS FORM, HANYA OVERRIDE SUBMIT-NYA
    =================================================== */
    $('#formVerifikasi').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                $('#verifModal').modal('hide');

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Status berhasil diperbarui',
                    timer: 1500,
                    showConfirmButton: false
                });

                // 🔥 INI KUNCI BIAR DATA BERUBAH
                table.ajax.reload(null, false);
            },
            error: function (xhr) {
                Swal.fire(
                    'Gagal',
                    xhr.responseJSON?.message || 'Terjadi kesalahan',
                    'error'
                );
            }
        });
    });

    /* =======================
       EDIT (PUT)
    ======================== */
    $('#proposalTable').on('click', '.btn-edit', function () {
        $('#editModal').modal('show');

        let editUrl = `{{ route('admin.proposal.update', ':id') }}`
            .replace(':id', $(this).data('id'));

        $('#formEdit').attr('action', editUrl);
        $('#editTahapan').val($(this).data('tahap_id'));
        $('#editStatus').val($(this).data('status'));
        $('#linkCurrentFile').attr('href', $(this).data('file'));
    });

    /* =======================
       DELETE
    ======================== */
    $('#proposalTable').on('click', '.btn-delete', function () {
        const id = $(this).data('id');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                let deleteUrl = `{{ route('admin.proposal.destroy', ':id') }}`
                    .replace(':id', id);

                $.ajax({
                    url: deleteUrl,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        Swal.fire('Berhasil!', res.message, 'success');
                        table.ajax.reload(null, false);
                    },
                    error: function (xhr) {
                        Swal.fire(
                            'Gagal',
                            xhr.responseJSON?.message || 'Terjadi kesalahan',
                            'error'
                        );
                    }
                });
            }
        });
    });

});
</script>


@endpush