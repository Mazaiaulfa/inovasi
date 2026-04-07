@extends('layouts.app')
@section('title', 'Penetapan Juri')

@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.dataTables_wrapper .dataTables_filter {
    display: flex !important;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    flex-direction: row-reverse;
}

.main-content {
    padding-top: 20px;
}
</style>
@endpush

@section('main')
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>Daftar Juri</h4>
                </div>

                <div class="card-body">
                    <div class="mb-3 d-flex justify-content-between">
                    <h6 class="mb-0 text-muted">Manajemen Data Juri</h6>

                    <a href="{{ route('admin.juri.create') }}" class="btn btn-primary btn-sm">
                         Add Juri
                    </a>
                </div>
                    <div class="table-responsive">
                        <table id="juriTable" class="table table-striped table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($juri as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                                        <td class="d-flex gap-1">

                            {{-- PENETAPAN --}}
                            <a href="{{ route('admin.juri.assign.form', $item->id) }}"
                            class="btn btn-primary btn-sm"
                            title="Penetapan">
                               <i class="fas fa-users-cog"></i>
                            </a>

                            {{-- LIHAT PESERTA --}}
                            <a href="{{ route('admin.juri.peserta', $item->id) }}"
                            class="btn btn-info btn-sm"
                            title="Lihat Gugus">
                                <i class="fas fa-eye"></i>
                            </a>

                            {{-- EDIT --}}
                            <a href="{{ route('admin.juri.edit', $item->id) }}"
                            class="btn btn-warning btn-sm"
                            title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>

                            {{-- DELETE --}}
                            <form action="{{ route('admin.juri.destroy', $item->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin mau hapus data ini?')"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </form>

                        </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

<script>
$(function () {
    $('#juriTable').DataTable({
        responsive: true,
        columnDefs: [
            { orderable: false, targets: [3] }
        ]
    });
});
</script>
@endpush
