@extends('layouts.app')
@section('title', 'Kelola Pengumuman & Timeline')

@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* DataTables Filter Styling */
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

/* Card styling */
.card {
    background-color: #fff;
}

/* Jarak antara navbar dan konten */
.main-content {
    padding-top: 20px;
}
</style>
@endpush

@section('main')
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">

            <!-- Card utama -->
            <div class="card">
                <div class="card-header">
                    <h4>Kelola Pengumuman & Timeline</h4>
                </div>
                <div class="card-body">

                    <!-- Nav Tabs di dalam card -->
                    <ul class="nav nav-tabs mb-3" id="dataTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pengumuman-tab" data-bs-toggle="tab" data-bs-target="#pengumuman" type="button" role="tab" aria-controls="pengumuman" aria-selected="true">
                                Pengumuman
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="timeline-tab" data-bs-toggle="tab" data-bs-target="#timeline" type="button" role="tab" aria-controls="timeline" aria-selected="false">
                                Timeline
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="dataTabContent">

                        <!-- Pengumuman Tab -->
                        <div class="tab-pane fade show active" id="pengumuman" role="tabpanel" aria-labelledby="pengumuman-tab">
                            <div class="mb-3">
                                <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Pengumuman
                                </a>
                            </div>
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
                                            <th>Status</th>
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
                                                    <a href="{{ asset($item->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File</a>
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
                                <div class="mt-3">{{ $pengumumans->links() }}</div>
                            </div>
                        </div>

                        <!-- Timeline Tab -->
                        <div class="tab-pane fade" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                            <div class="mb-3">
                                <a href="{{ route('admin.timeline.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Timeline
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table id="timelineTable" class="table table-striped table-bordered table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Urutan</th>
                                            <th>Tahap</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($timelines as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->urutan }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->tanggal_mulai }}</td>
                                            <td>{{ $item->tanggal_selesai ?? '-' }}</td>
                                            <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                            <td class="d-flex gap-2">
                                                <a href="{{ route('admin.timeline.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.timeline.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">{{ $timelines->links() }}</div>
                            </div>
                        </div>

                    </div> <!-- end tab-content -->

                </div> <!-- end card-body -->
            </div> <!-- end card -->

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
            { "orderable": false, "targets": [7,8] } // file & aksi
        ]
    });

    $('#timelineTable').DataTable({
        responsive: true,
        "columnDefs": [
            { "orderable": false, "targets": [6] } // aksi
        ]
    });
});
</script>
@endpush
