@extends('layouts.app')
@section('title', 'Kelola Anggota')

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
                            <h4>Daftar Anggota</h4>
                            <button type="button" class="btn btn-primary" id="btn-tambah">Tambah Anggota</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered w-100" id="anggota-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                             <th>No Badge</th>
                                            <th>Jabatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Tambah/Edit -->
                    <div class="modal fade" id="anggotaModal" tabindex="-1" aria-labelledby="anggotaModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="anggotaForm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="anggotaModalLabel">Tambah Anggota</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="anggota_id" name="anggota_id">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" required>
                                            <div class="invalid-feedback" id="nama-error"></div>
                                        </div>
                                        <div class="form-group mt-2">
    <label for="badge">No Badge</label>
    <input type="text" class="form-control" id="badge" name="badge" required>
    <div class="invalid-feedback" id="badge-error"></div>
</div>

                                        <div class="form-group mt-2">
                                            <label for="jabatan">Jabatan</label>
                                            <select class="form-control" id="jabatan" name="jabatan" required>
                                                <option value="" disabled selected>Pilih Jabatan Anggota ..... </option>
                                                <option value="ketua">Ketua</option>
                                                <option value="sekretaris">Sekretaris</option>
                                                <option value="fasilitator">Fasilitator</option>
                                                <option value="anggota">Anggota</option>
                                            </select>
                                            <div class="invalid-feedback" id="jabatan-error"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary" type="submit" id="saveBtn">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Konfirmasi Hapus -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus anggota ini?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                                </div>
                            </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const table = $('#anggota-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('anggota.index') }}",
            columns: [
               { data: 'id', render: (data, type, row, meta) => meta.row + 1 },
                { data: 'nama', name: 'nama' },
                 { data: 'badge', name: 'badge' },
                { data: 'jabatan', name: 'jabatan' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        function resetModal() {
            $('#anggotaForm').trigger("reset");
            $('#anggota_id').val('');
            $('.invalid-feedback').text('');
            $('.form-control').removeClass('is-invalid');
        }

        $('#btn-tambah').click(function () {
            resetModal();
            $('#anggotaModalLabel').text('Tambah Anggota');
            $('#anggotaModal').modal('show');
        });

        $('#anggotaForm').submit(function (e) {
            e.preventDefault();
            $('.invalid-feedback').text('');
            $('.form-control').removeClass('is-invalid');

            const formData = {
                nama: $('#nama').val(),
                 badge: $('#badge').val(),
                jabatan: $('#jabatan').val(),
            };

            const id = $('#anggota_id').val();
           const url = id ? `{{ url('user/anggota') }}/${id}` : `{{ route('anggota.store') }}`;
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: formData,
                success: function (response) {
                    $('#anggotaModal').modal('hide');
                    table.ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        timer: 1500
                    });
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $(`#${key}`).addClass('is-invalid');
                            $(`#${key}-error`).text(value[0]);
                        });

                        if(xhr.responseJSON.message) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseJSON.message
                            });
                        }

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message || 'Terjadi kesalahan. Silakan coba lagi.'
                        });
                    }
                }
            });
        });

        $('#anggota-table').on('click', '.edit-btn', function () {
            resetModal();
            const id = $(this).data('id');

            $.get(`{{ url('user/anggota') }}/${id}/edit`, function (response) {
                $('#anggota_id').val(response.data.id);
                $('#nama').val(response.data.nama);
                $('#badge').val(response.data.badge);
                $('#jabatan').val(response.data.jabatan);
                $('#anggotaModalLabel').text('Edit Anggota');
                $('#anggotaModal').modal('show');
            }).fail(function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON.message || 'Terjadi kesalahan. Silakan coba lagi.'
                });
            });
        });

        let deleteId;
        $('#anggota-table').on('click', '.delete-btn', function () {
            deleteId = $(this).data('id');
            $('#deleteModal').modal('show');
        });

        $('#confirmDelete').click(function () {
            $.ajax({
                url: `{{ url('user/anggota') }}/${deleteId}`,
                type: 'DELETE',
                success: function (response) {
                    $('#deleteModal').modal('hide');
                    table.ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        timer: 1500
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message || 'Terjadi kesalahan. Silakan coba lagi.'
                    });
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
