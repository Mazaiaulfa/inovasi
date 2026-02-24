@extends('layouts.app')
@section('title', 'Kelola Pengumuman')

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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Kelola Pengumuman</h4>
                            <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Pengumuman
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                              <table id="pengumumanTable" class="table table-striped table-bordered table-hover w-100">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Ringkasan</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Urgent</th>
            <th>Status</th> <!-- is_active -->
            <th>File</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengumumans as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->judul }}</td>
            <td>{{ Str::limit($item->ringkasan, 50) }}</td>
            <td>{{ $item->tanggal_mulai }}</td>
            <td>{{ $item->tanggal_selesai ?? '-' }}</td>
            <td>
                @if($item->urgent)
                    <span class="badge bg-danger">PENTING</span>
                @else
                    <span class="badge bg-secondary">Normal</span>
                @endif
            </td>
            <td>
                @if($item->is_active)
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-secondary">Nonaktif</span>
                @endif
            </td>
            <td>
    @if($item->file)
        @php
            $extension = pathinfo($item->file, PATHINFO_EXTENSION);
        @endphp

        {{-- Jika file gambar --}}
        @if(in_array(strtolower($extension), ['jpg','jpeg','png','gif','webp']))
            <img src="{{ asset($item->file) }}"
                 class="img-thumbnail"
                 style="width:100px; height:80px; object-fit:cover;">

        {{-- Jika file PDF --}}
        @elseif(strtolower($extension) == 'pdf')
            <div class="d-flex flex-column align-items-center">
                <i class="fas fa-file-pdf text-danger" style="font-size:40px;"></i>
                <a href="{{ asset($item->file) }}"
                   target="_blank"
                   class="btn btn-sm btn-outline-danger mt-1">
                   Lihat PDF
                </a>
            </div>

        {{-- Jika file Word --}}
        @elseif(in_array(strtolower($extension), ['doc','docx']))
            <div class="d-flex flex-column align-items-center">
                <i class="fas fa-file-word text-primary" style="font-size:40px;"></i>
                <a href="{{ asset($item->file) }}"
                   class="btn btn-sm btn-outline-primary mt-1">
                   Download
                </a>
            </div>

        @else
            <a href="{{ asset($item->file) }}" class="btn btn-sm btn-secondary">
                Download File
            </a>
        @endif
    @else
        -
    @endif
</td>
            <td class="d-flex gap-2">
                <a href="{{ route('admin.pengumuman.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.pengumuman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

                                {{-- Pagination jika pakai manual --}}
                                <div class="mt-3">
                                    {{ $pengumumans->links() }}
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
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script>
$(function () {
    $('#pengumumanTable').DataTable({
        responsive: true,
        "columnDefs": [
            { "orderable": false, "targets": [6,7] } // gambar & aksi tidak bisa di-sort
        ]
    });
});
</script>
@endpush
