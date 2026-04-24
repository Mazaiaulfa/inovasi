@extends('layouts.app')

@section('title', 'Show Nilai Peserta')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<style>

.table-custom {
    border-collapse: collapse;
    width: 100%;
    font-size: 12px;
}

.table-custom th,
.table-custom td {
    border: 1px solid #dee2e6;
    padding: 8px;
    vertical-align: middle;
}

.table-custom th {
    background: #6c757d;
    color: white;
    text-align: center;
}

.status-ok {
    color: green;
    font-weight: bold;
}

.status-bad {
    color: red;
    font-weight: bold;
}
</style>
@endpush

@section('main')
<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Edit Nilai Peserta</h1>
</div>

<div class="section-body">
<div class="card">
<div class="card-body">


<h5 class="text-center mb-3">
    {{ $karya->user->name }}
</h5>

<div class="mb-3 text-center">
    <b>Judul:</b> {{ $karya->judul }} <br>
    <b>Direktorat:</b> {{ $karya->user->direktorat ?? '-' }} |
    <b>Kompartemen:</b> {{ $karya->user->kompartemen ?? '-' }} |
    <b>Departemen:</b> {{ $karya->user->unit_kerja ?? '-' }}
</div>

<hr>


<div class="table-responsive">
<table class="table-custom">

<thead>

<tr>
    <th width="50">No</th>
    <th>Nama Juri</th>
    <th width="120">Total Nilai</th>
    <th width="150">Status</th>
    <th width="120">Aksi</th>
</tr>

</thead>
<tbody>
@foreach($penilaians as $i => $p)
<tr>

    <td class="text-center">{{ $i+1 }}</td>

    <td>{{ $p->juri->name }}</td>

    <td class="text-center">
        <b>{{ $p->total_nilai ?? '-' }}</b>
    </td>

<td class="text-center">
    @if($p->status == 'draft')
        <span class="status-bad">Belum Dinilai</span>
    @else
        <span class="status-ok">Sudah Dinilai</span>
    @endif
</td>


    {{-- AKSI --}}
    <td class="text-center">

        {{-- DETAIL --}}
        <a href="{{ route('admin.nilai.detail', $p->id) }}"
           class="btn btn-info btn-sm">
            <i class="bi bi-eye"></i>
        </a>

        {{-- EDIT
        @if($p->status != 'published')
            <a href="{{ route('admin.nilai.edit', $p->id) }}"
               class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-square"></i>
            </a>
        @endif --}}

    </td>

</tr>
@endforeach
</tbody>

</table>
</div>

{{-- ===================== --}}
{{-- 🔙 TOMBOL --}}
{{-- ===================== --}}
<div class="mt-4">
    <a href="{{ route('admin.konvensi.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

</div>
</div>
</div>

</section>
</div>
@endsection
