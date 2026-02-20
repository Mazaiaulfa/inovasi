@extends('layouts.app')
@section('title', 'Upload Proposal')

@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endpush

@section('main')
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Upload Proposal</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('proposal.store') }}" method="POST" enctype="multipart/form-data"
                                class="mb-4">
                                @csrf
                                <div class="form-group">
                                    <label for="karya_id">Judul Makalah</label>
                                    <select name="karya_id" class="form-control" required>
                                        <option value="" disabled selected>Pilih Judul Makalah ... </option>
                                        @foreach (Auth::user()->karyaTulis as $karya)
                                        <option value="{{ $karya->id }}">{{ $karya->judul }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tahap_id">Tahapan</label>
                                    <select name="tahap_id" class="form-control" required>
                                        <option value="" disabled selected>--- Pilih Tahapan ---</option>
                                        @foreach ($tahapan as $t)
                                        <option value="{{ $t->id }}">- {{ $t->nama }} -
                                            {{ $t->deskripsi }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="file">File Proposal (PDF)</label>
                                    <input type="file" name="file" class="form-control" accept="application/pdf"
                                        required>
                                </div>
                                <button class="btn btn-primary mt-3">Upload</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-12 card mt-4">
                        <div class="card-header">
                            <h4>Daftar Proposal</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="proposal-table" class="table table-bordered w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Tahapan</th>
                                            <th>File</th>
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
</div>

@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $('#proposal-table').DataTable({
            processing: true
            , serverSide: true
            , ajax: '{{ route('proposal.data') }}'
            , columns: [{
                    data: 'id'
                    , render: (data, type, row, meta) => meta.row + 1
                }
                , {
                    data: 'judul'
                }
                , {
                    data: 'tahapan'
                }
                , {
                    data: 'file'
                }
                , {
                    data: 'waktu_upload'
                }
                , {
                    data: 'status'
                }
                , {
                    data: 'aksi'
                }
            ]
        });
    });

    $(document).on('click', '.btn-delete', function() {
        let url = $(this).data('url');
        let judul = $(this).data('judul');

        Swal.fire({
            title: 'Yakin ingin menghapus?'
            , text: `Proposal "${judul}" akan dihapus permanen!`
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#d33'
            , cancelButtonColor: '#3085d6'
            , confirmButtonText: 'Ya, hapus!'
            , cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url
                    , type: 'POST'
                    , data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                        , _method: 'DELETE'
                    }
                    , success: function(res) {
                        if (res.status) {
                            Swal.fire('Berhasil', res.message, 'success');
                        } else {
                            Swal.fire('Peringatan', res.message, 'warning');
                        }
                        $('#proposal-table').DataTable().ajax.reload();
                    }
                    , error: function(xhr) {
                        let msg = 'Terjadi kesalahan saat menghapus data.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        Swal.fire('Peringatan', msg, 'warning');
                    }
                });
            }
        });
    });

</script>
@endpush