@extends('layouts.app')

@section('title', 'Detail Gugus Inovasi')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<style>
/* Card info modern kecil & lembut */
.info-gugus {
    display: flex;
    flex-wrap: wrap;
    gap: 0.8rem;
    margin-bottom: 1rem;
}

.info-gugus .info-item {

    background-color: #f1f5f9; /* lembut */
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    font-size: 0.85rem;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    flex: 1 1 calc(33.333% - 0.8rem); /* 3 kolom */
    max-width: calc(33.333% - 0.8rem);
}

/* List anggota minimal */
.anggota-list {
    list-style: none;
    padding-left: 0;
    margin-top: 0.5rem;
}

.anggota-list li {
    margin-bottom: 4px;
    padding: 3px 0;
    border-bottom: 1px solid #e2e8f0; /* tipis & soft */
    font-size: 0.85rem;
    color: #495057;
}

/* Table detail modern */
#detailTable td, #detailTable th {
    vertical-align: middle;
    white-space: nowrap;
    padding: 0.55rem 0.65rem;
    font-size: 0.85rem;
}

#detailTable td:nth-child(2),
#detailTable th:nth-child(2) {
    white-space: normal;
    word-break: break-word;
    min-width: 300px;
    max-width: 400px;
}

.table-responsive {
    overflow-x: auto;
}

#detailTable tbody tr:hover {
    background-color: #f8f9fa;
}

/* Badge status lebih kecil & warna lembut */
.status-badge {
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 500;
    color: #fff;
}

/* Tombol Lihat lebih kecil */
.btn-sm {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}
@media (max-width: 768px) {
    .info-gugus .info-item {
        flex: 1 1 100%;
        max-width: 100%;
    }
}
</style>
@endpush

@section('main')
<div class="main-content">
    <div class="container-fluid">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Detail Gugus: {{ $gugus->name }}</h5>
                            <a href="{{ route('admin.history.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="card-body">
                           <div class="info-gugus">

    <div class="info-item"><strong>Direktorat:</strong> {{ $gugus->direktorat ?? '-' }}</div>
    <div class="info-item"><strong>Kompartemen:</strong> {{ $gugus->kompartemen ?? '-' }}</div>
    <div class="info-item"><strong>Unit Kerja:</strong> {{ $gugus->unit_kerja ?? '-' }}</div>

    <div class="info-item"><strong>Ketua:</strong> {{ $gugus->ketua }}</div>
    <div class="info-item"><strong>Fasilitator:</strong> {{ $gugus->fasilitator }}</div>

    <div class="info-item">
        <strong>Anggota Lain:</strong>
        <ul class="anggota-list">
            @foreach($gugus->anggota_lain as $anggota)
                <li>{{ $anggota->nama }}</li>
            @endforeach
        </ul>
    </div>

</div>

</div>
                            <div class="table-responsive mt-2">
                                <table id="detailTable" class="table table-striped table-bordered table-hover w-100">
                        <thead class="table-light">
                            <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Profile Judul</th>
                            <th>Proposal</th>
                            <th>Final</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            </tr>
                            </thead>
                                    <tbody>
                                @foreach($gugus->karyaTulis as $key => $karya)

                                <tr>

                                <td>{{ $key + 1 }}</td>

                                <td>{{ $karya->judul }}</td>

                                <td>
                                @if($karya->file_ajukan)
                                <a href="{{ asset($karya->file_ajukan) }}" target="_blank" class="btn btn-success btn-sm">
                                <i class="fas fa-file-alt"></i> Judul
                                </a>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                                </td>

                                <td>

                                @if($karya->proposals->isEmpty())
                                <span class="text-muted">Belum ada</span>
                                @else

                                @foreach($karya->proposals as $p)

                                <div class="mb-1">

                               <a href="{{ asset($p->file_path) }}" target="_blank" class="btn btn-info btn-sm">

                                Proposal Tahap {{ $p->tahapan->urutan ?? '-' }}

                                </a>

                                </div>

                                @endforeach

                                @endif

                                </td>

                                <td>

                                @if($karya->finalKarya)

                                <a href="{{ asset($karya->finalKarya->file_path) }}" target="_blank" class="btn btn-primary btn-sm">

                                Final

                                </a>

                                @else

                                <span class="text-muted">Belum Final</span>

                                @endif

                                </td>

                                <td>

                                <span class="status-badge bg-{{ $karya->status_color }}">

                                {{ ucfirst($karya->status_judul) }}

                                </span>

                                </td>

                                <td>{{ $karya->created_at->translatedFormat('d F Y') }}</td>

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
     </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(function() {
    $('#detailTable').DataTable({
        paging: false,
        searching: false,
        info: false,
        ordering: false
    });
});
</script>
@endpush
