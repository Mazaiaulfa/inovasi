@extends('layouts.app')
@section('title', 'Verifikasi Final Karya')

@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('main')
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Verifikasi Final Karya</h4>
                        </div>
                        <div class="card-body">
                            <table id="finalTable" class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
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

<!-- Modal Verifikasi -->
<div class="modal fade" id="verifModal" tabindex="-1" aria-labelledby="verifModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="formVerifikasi">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verifikasi Final Karya</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama: <span id="namaUser"></span></strong></p>
                    <p><strong>Judul: <span id="judulKarya"></span></strong></p>
                    <div class="mb-3">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="pending">Pending</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                        <div class="invalid-feedback" id="statusError"></div>
                    </div>
                    <div class="mb-3">
                        <label>Catatan</label>
                        <textarea name="catatan" id="catatan" class="form-control" rows="3"></textarea>
                        <div class="invalid-feedback" id="catatanError"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" id="btnSimpan">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Final Karya -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="formEditFinal">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Final Karya</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama: <span id="editNamaUser"></span></strong></p>
                    <p><strong>Judul: <span id="editJudulKarya"></span></strong></p>
                    <div class="mb-3">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" id="editStatus" class="form-control form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="pending">Pending</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                        <div class="invalid-feedback" id="editStatusError"></div>
                    </div>
                    <div class="mb-3">
                        <label>Catatan</label>
                        <textarea name="catatan" id="editCatatan" class="form-control" rows="3"></textarea>
                        <div class="invalid-feedback" id="editCatatanError"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnUpdateFinal">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function () {

        // BASE URL AMAN SUBFOLDER
        const ADMIN_FINAL_BASE = "{{ url('admin/final-karya') }}";

        const table = $('#finalTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('admin.final.index') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                { data: 'nama' },
                { data: 'judul' },
                {
                    data: 'file',
                    orderable: false,
                    searchable: false
                },
                { data: 'catatan' },
                {
                    data: 'status',
                    render: data => {
                        const badge = {
                            pending: 'warning',
                            disetujui: 'success',
                            ditolak: 'danger'
                        }[data] || 'secondary';

                        return `<span class="badge bg-${badge}">${data}</span>`;
                    }
                },
                {
                    data: 'aksi',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        /* ======================
           VERIFIKASI
        ====================== */
        $('#finalTable').on('click', '.btn-verif', function () {
            const btn = $(this);

            $('#namaUser').text(btn.data('nama'));
            $('#judulKarya').text(btn.data('judul'));
            $('#status').val(btn.data('status'));
            $('#catatan').val(btn.data('notes'));

            $('#formVerifikasi').attr(
                'action',
                `${ADMIN_FINAL_BASE}/${btn.data('id')}`
            );

            $('#verifModal').modal('show');
        });

        $('#formVerifikasi').submit(function (e) {
            e.preventDefault();

            const form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                beforeSend: () => $('#btnSimpan').prop('disabled', true),
                success: () => {
                    $('#verifModal').modal('hide');
                    table.ajax.reload(null, false);
                    Swal.fire('Berhasil', 'Final karya diverifikasi.', 'success');
                },
                error: xhr => {
                    if (xhr.status === 422) {
                        const errs = xhr.responseJSON.errors;
                        Object.keys(errs).forEach(k => {
                            $(`#${k}`).addClass('is-invalid');
                            $(`#${k}Error`).text(errs[k][0]);
                        });
                    } else {
                        Swal.fire('Error', 'Terjadi kesalahan.', 'error');
                    }
                },
                complete: () => $('#btnSimpan').prop('disabled', false)
            });
        });

        $('#verifModal').on('hidden.bs.modal', () => {
            $('#formVerifikasi')[0].reset();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');
        });

        /* ======================
           EDIT
        ====================== */
        $('#finalTable').on('click', '.btn-edit', function () {
            const btn = $(this);

            $('#editNamaUser').text(btn.data('nama'));
            $('#editJudulKarya').text(btn.data('judul'));
            $('#editStatus').val(btn.data('status'));
            $('#editCatatan').val(btn.data('notes'));

            $('#formEditFinal').attr(
                'action',
                `${ADMIN_FINAL_BASE}/${btn.data('id')}`
            );

            $('#editModal').modal('show');
        });

        $('#formEditFinal').submit(function (e) {
            e.preventDefault();

            const form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                beforeSend: () => $('#btnUpdateFinal').prop('disabled', true),
                success: () => {
                    $('#editModal').modal('hide');
                    table.ajax.reload(null, false);
                    Swal.fire('Berhasil', 'Data berhasil diperbarui.', 'success');
                },
                error: xhr => {
                    if (xhr.status === 422) {
                        const errs = xhr.responseJSON.errors;
                        Object.keys(errs).forEach(k => {
                            const id = `edit${k.charAt(0).toUpperCase() + k.slice(1)}`;
                            $(`#${id}`).addClass('is-invalid');
                            $(`#${id}Error`).text(errs[k][0]);
                        });
                    } else {
                        Swal.fire('Gagal', 'Terjadi kesalahan.', 'error');
                    }
                },
                complete: () => $('#btnUpdateFinal').prop('disabled', false)
            });
        });

        $('#editModal').on('hidden.bs.modal', () => {
            $('#formEditFinal')[0].reset();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');
        });

        /* ======================
           DELETE
        ====================== */
        $('#finalTable').on('click', '.btn-delete', function () {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, hapus!'
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${ADMIN_FINAL_BASE}/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: res => {
                            Swal.fire('Berhasil', res.message, 'success');
                            table.ajax.reload(null, false);
                        },
                        error: () => {
                            Swal.fire('Gagal', 'Terjadi kesalahan.', 'error');
                        }
                    });
                }
            });
        });

    });
</script>

@endpush