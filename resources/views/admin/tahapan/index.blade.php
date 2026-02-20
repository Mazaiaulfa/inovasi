@extends('layouts.app')

@section('title', 'Kelola Tahapan')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endpush

@section('main')
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Kelola Tahapan</h4>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tahapanModal"
                                id="btnTambah">
                                Tambah Tahapan
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tahapanTable" class="table table-bordered table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tahapan</th>
                                            <th>Deskripsi</th>
                                            <th>Urutan</th>
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

<!-- Modal Tambah/Edit -->
<div class="modal fade" id="tahapanModal" tabindex="-1" aria-labelledby="tahapanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formTahapan">
            @csrf
            <input type="hidden" id="tahapan_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tahapanModalLabel">Tambah Tahapan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama">Nama Tahapan</label>
                        <input type="text" name="nama" id="nama" class="form-control">
                        <div class="invalid-feedback" id="nama-error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                        <div class="invalid-feedback" id="deskripsi-error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="urutan">Urutan</label>
                        <input type="number" name="urutan" id="urutan" class="form-control">
                        <div class="invalid-feedback" id="urutan-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {

        const baseUrl = "{{ url('') }}";

        const table = $('#tahapanTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("tahapan.index") }}',
            columns: [
                { 
                    data: 'id', name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'nama', name: 'nama' },
                { data: 'deskripsi', name: 'deskripsi' },
                { data: 'urutan', name: 'urutan' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        $('#btnTambah').on('click', function () {
            $('#tahapan_id').val('');
            $('#formTahapan')[0].reset();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#tahapanModalLabel').text('Tambah Tahapan');
        });

        $('#formTahapan').submit(function (e) {
            e.preventDefault();
            let id = $('#tahapan_id').val();
            let url = id 
                ? `${baseUrl}/admin/tahapan/${id}` 
                : `{{ route("tahapan.store") }}`;

            let method = id ? 'PUT' : 'POST';

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            $.ajax({
                url: url,
                method: method,
                data: $(this).serialize(),
                success: function (response) {
                    $('#tahapanModal').modal('hide');
                    table.ajax.reload(null, false);
                    Swal.fire('Berhasil', response.message, 'success');
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, val) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key + '-error').text(val[0]);
                        });

                        if (xhr.responseJSON.message) {
                            Swal.fire('Gagal', xhr.responseJSON.message, 'error');
                        }
                    } else {
                        Swal.fire('Gagal', xhr.responseJSON.message || 'Terjadi kesalahan', 'error');
                    }
                }
            });
        });

        $(document).on('click', '.edit-btn', function () {
            let id = $(this).data('id');
            $.get(`${baseUrl}/admin/tahapan/${id}`, function (response) {
                $('#tahapanModal').modal('show');
                $('#tahapan_id').val(response.data.id);
                $('#nama').val(response.data.nama);
                $('#deskripsi').val(response.data.deskripsi);
                $('#urutan').val(response.data.urutan);
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                $('#tahapanModalLabel').text('Edit Tahapan');
            }).fail(function () {
                Swal.fire('Gagal', 'Data tidak ditemukan', 'error');
            });
        });

        $(document).on('click', '.delete-btn', function () {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Yakin ingin hapus?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${baseUrl}/admin/tahapan/${id}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            table.ajax.reload(null, false);
                            Swal.fire('Berhasil', response.message, 'success');
                        },
                        error: function (xhr) {
                            Swal.fire('Gagal', xhr.responseJSON.message || 'Terjadi kesalahan', 'error');
                        }
                    });
                }
            });
        });

    });
</script>

@endpush