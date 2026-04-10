@extends('layouts.app')

@section('title', 'Kelola Kriteria')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
.main-content {
    padding-top: 20px;
}


.modal-body ol {
    padding-left: 20px;
}

.modal-body li {
    margin-bottom: 5px;
}

.table td, .table th {
    vertical-align: middle;
    font-size: 13px;
}

td {
    max-width: 180px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* 🔥 TAB BAGUS */
.nav-tabs .nav-link {
    border: none;
    color: #555;
    font-weight: 500;
}

.nav-tabs .nav-link.active {
    background-color: #7ea0d2;
    color: white;
    border-radius: 12px;
}

/*AKSI BIAR GA TURUN */
.aksi-btn {
    display: flex;
    gap: 6px;
    justify-content: center;
    white-space: nowrap;
}

.aksi-btn form {
    margin: 0;
}
</style>
@endpush

@section('main')
<div class="main-content">
<div class="container-fluid">
<div class="card">

<div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Kelola Kriteria Penilaian</h4>

    <a href="{{ route('admin.kriteria.create') }}" class="btn btn-primary">
        + Add Kriteria
    </a>
</div>

<div class="card-body">

<!-- TAB -->
<ul class="nav nav-tabs mb-3">
@foreach($kriterias as $item => $data)
    <li class="nav-item">
        <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                data-bs-toggle="tab"
                data-bs-target="#{{ strtolower($item) }}">
            {{ strtoupper($item) }}
        </button>
    </li>
@endforeach
</ul>

<!-- CONTENT -->
<div class="tab-content">

@foreach($kriterias as $item => $rows)
<div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ strtolower($item) }}">

<div class="mb-3">
    <a href="{{ route('admin.kriteria.create') }}?item={{ $item }}" class="btn btn-primary">
        + Tambah {{ $item }}
    </a>
</div>

<div class="table-responsive">
<table class="table table-bordered table-striped align-middle">
<thead class="table-secondary">
<tr>
    <th width="5%">No</th>
    <th>Kriteria</th>
    <th>Keterangan</th>
    <th>Rujukan</th>
    <th width="10%">Skala</th>
    <th width="12%">Aksi</th>
</tr>
</thead>

<tbody>
@foreach($rows as $k)
<tr>
    <td>{{ $k->no }}</td>

    <td>{{ $k->nama }}</td>

    <td>{{ Str::limit($k->keterangan, 40) }}</td>

    <td>{{ Str::limit($k->rujukan, 30) }}</td>

   <td class="text-center">
    <button class="btn btn-sm btn-info"
        data-bs-toggle="modal"
        data-bs-target="#modal{{ $k->id }}">
        <i class="bi bi-eye"></i>
    </button>
</td>

<td class="aksi-btn">

    <!-- EDIT -->
    <a href="{{ route('admin.kriteria.edit', $k->id) }}"
       class="btn btn-sm btn-warning"
       data-bs-toggle="tooltip"
       title="Edit">
        <i class="bi bi-pencil"></i>
    </a>

    <!-- DELETE -->
    <form action="{{ route('admin.kriteria.destroy', $k->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="btn btn-sm btn-danger"
                data-bs-toggle="tooltip"
                title="Hapus"
                onclick="return confirm('Yakin hapus?')">
            <i class="bi bi-trash"></i>
        </button>
    </form>

</td>
</tr>

<!-- MODAL -->
<div class="modal fade" id="modal{{ $k->id }}" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title">{{ $k->nama }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

{{-- ================= KETERANGAN ================= --}}
<p><strong>Keterangan:</strong></p>
<ol>
@foreach(explode("\n", $k->keterangan) as $text)
    @php
        $text = trim($text);
        $text = preg_replace('/^\d+\.\s*/', '', $text);
    @endphp

    @if($text)
        <li>{{ $text }}</li>
    @endif
@endforeach
</ol>

<hr>

{{-- ================= SKALA ================= --}}
@foreach([
    '1 - 4' => $k->skala_1_4,
    '5 - 6' => $k->skala_5_6,
    '7 - 8' => $k->skala_7_8,
    '9 - 10' => $k->skala_9_10,
] as $label => $value)

<p><strong>Skala {{ $label }}:</strong></p>
<ol>
@foreach(explode("\n", $value) as $text)
    @php
        $text = trim($text);
        $text = preg_replace('/^\d+\.\s*/', '', $text);
    @endphp

    @if($text)
        <li>{{ $text }}</li>
    @endif
@endforeach
</ol>

@endforeach

</div>

</div>
</div>
</div>

@endforeach
</tbody>
</table>
</div>

</div>
@endforeach

</div>

</div>
</div>
</div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (el) {
        return new bootstrap.Tooltip(el)
    })
});
</script>
@endpush
