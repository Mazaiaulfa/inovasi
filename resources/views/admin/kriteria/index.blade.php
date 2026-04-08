@extends('layouts.app')
@section('title', 'Kelola Kriteria')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
.main-content {
    padding-top: 20px;
}

td {
    max-width: 180px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.modal-body ol {
    padding-left: 20px;
}

.modal-body li {
    margin-bottom: 5px;
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
            {{ $item }}
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
<table class="table table-bordered table-striped">
<thead>
<tr>
    <th>No</th>
    <th>Kriteria</th>
    <th>Keterangan</th>
    <th>Rujukan</th>
    <th>Skala</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
@foreach($rows as $k)
<tr>
    <td>{{ $k->no }}</td>

    <td>{{ $k->nama }}</td>

    <td>{{ Str::limit($k->keterangan, 40) }}</td>

    <td>{{ Str::limit($k->rujukan, 30) }}</td>

    <td>
        <button class="btn btn-sm btn-info"
            data-bs-toggle="modal"
            data-bs-target="#modal{{ $k->id }}">
            Lihat
        </button>
    </td>

   <td class="d-flex gap-2 align-items-center">

    <!-- EDIT -->
    <a href="{{ route('admin.kriteria.edit', $k->id) }}"
       class="btn btn-sm btn-warning"
       data-bs-toggle="tooltip"
       title="Edit Data">
        <i class="bi bi-pencil"></i>
    </a>

    <!-- DELETE -->
    <form action="{{ route('admin.kriteria.destroy', $k->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="btn btn-sm btn-danger"
                data-bs-toggle="tooltip"
                title="Hapus Data"
                onclick="return confirm('Yakin hapus data ini?')">
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

<p><strong>Keterangan:</strong></p>
<ol>
@foreach(explode("\n", $k->keterangan) as $item)
    @php
        $item = trim($item);
        $item = preg_replace('/^\d+\.\s*/', '', $item);
    @endphp

    @if($item != '')
        <li>{{ $item }}</li>
    @endif
@endforeach
</ol>

<hr>

{{-- FUNCTION BERSIHIN NOMOR --}}
@php
    function cleanList($text) {
        $lines = explode("\n", $text);
        $result = [];

        foreach ($lines as $line) {
            $line = trim($line);
            // hapus "1." "2." dst
            $line = preg_replace('/^\d+\.\s*/', '', $line);

            if ($line != '') {
                $result[] = $line;
            }
        }

        return $result;
    }
@endphp

<p><strong>Skala 1 - 4:</strong></p>
<ol>
@foreach(cleanList($k->skala_1_4) as $item)
    <li>{{ $item }}</li>
@endforeach
</ol>

<p><strong>Skala 5 - 6:</strong></p>
<ol>
@foreach(cleanList($k->skala_5_6) as $item)
    <li>{{ $item }}</li>
@endforeach
</ol>

<p><strong>Skala 7 - 8:</strong></p>
<ol>
@foreach(cleanList($k->skala_7_8) as $item)
    <li>{{ $item }}</li>
@endforeach
</ol>

<p><strong>Skala 9 - 10:</strong></p>
<ol>
@foreach(cleanList($k->skala_9_10) as $item)
    <li>{{ $item }}</li>
@endforeach
</ol>

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
@endpush
