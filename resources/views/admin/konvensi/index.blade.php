@extends('layouts.app')
@section('title', 'Konvensi Inovasi')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
.table-konvensi {
    width: 100%;
    border-collapse: collapse;
    font-size: 11px;
}
.table-konvensi th,
.table-konvensi td {
    border: 1px solid #000;
    padding: 5px;
}
.table-konvensi th {
    background: #ffaa01;
    text-align: center;
}
</style>
@endpush

@section('main')
<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Konvensi Inovasi</h1>
</div>

<div class="card">
<div class="card-body">
<div class="mb-3 d-flex justify-content-between align-items-center">

    <div></div> {{-- biar tombol ke kanan --}}

    <a href="{{ route('admin.konvensi.export') }}"
       class="btn btn-success btn-sm d-flex align-items-center gap-2">
        <i class="bi bi-file-earmark-excel"></i>
        Export Excel
    </a>

</div>
<div class="table-responsive">
<table class="table-konvensi">

<thead>
<tr>
    <th>No</th>
    <th>Nama Gugus</th>
    <th>Judul Karya</th>
    <th>Direktorat</th>
    <th>Kompartemen</th>
    <th>Departemen</th>
    <th>Total</th>
    <th>Apresiasi</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
@foreach($data as $i => $item)
<tr>
    <td class="text-center">{{ $i+1 }}</td>

    {{-- NAMA --}}
    <td>{{ $item->karya->user->name }}</td>

    {{-- JUDUL KARYA --}}
    <td>{{ $item->karya->judul ?? '-' }}</td>

    {{-- ORGANISASI --}}
    <td>{{ $item->karya->user->direktorat ?? '-' }}</td>
    <td>{{ $item->karya->user->kompartemen ?? '-' }}</td>
    <td>{{ $item->karya->user->unit_kerja ?? '-' }}</td>

    {{-- TOTAL NILAI --}}
    <td class="text-center">
        <b>{{ round($item->rata_nilai, 2) }}</b>
    </td>

    {{-- APRESIASI --}}
    <td class="text-center">
        @php $a = $item->apresiasi; @endphp

        @if($a == 'Diamond')
            <span class="">💎 Diamond</span>
        @elseif($a == 'Platinum')
            <span class="">Platinum</span>
        @elseif($a == 'Gold')
            <span class="">Gold</span>
        @elseif($a == 'Silver')
            <span class="">Silver</span>
        @elseif($a == 'Bronze')
            <span class="">Bronze</span>
        @else
            -
        @endif
    </td>

    {{-- STATUS PENILAIAN --}}
    <td class="text-center">
    @if($item->is_complete)
        <span style="color: green; font-weight: bold;">
            Sudah Dinilai Semua Juri
        </span>
    @else
        <span style="color: red; font-weight: bold;">
            Belum Dinilai Semua Juri
        </span>
    @endif
</td>

    {{-- AKSI --}}
    <td class="text-center">

        {{-- DETAIL --}}
        <a href="{{ route('admin.nilai.show', $item->karya_id) }}"
           class="btn btn-info btn-sm me-1">
            <i class="bi bi-eye"></i>
        </a>

    </td>
</tr>
@endforeach
</tbody>

</table>
</div>

</div>
</div>

</section>
</div>
@endsection
