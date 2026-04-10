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
    vertical-align: middle;
}

.table-konvensi th {
    background: #ffe600; /* 🔥 kuning */
    text-align: center;
    font-weight: bold;
}

.table-konvensi tbody tr:hover {
    background-color: #fffde7; /* hover kuning soft */
}

.text-center {
    text-align: center;
}

.badge {
    font-size: 10px;
    padding: 4px 6px;
}
</style>
@endpush

@section('main')
<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Konvensi Inovasi</h1>
</div>

<div class="section-body">
<div class="card">

<div class="card-header">
    <h4 class="mb-0">DaftarHasil Penilaian</h4>
</div>


<div class="card-body">
<div class="mb-3 d-flex justify-content-between align-items-center">

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
    <th width="40">No</th>
    <th>Nama</th>
    <th>Direktorat</th>
    <th>Kompartemen</th>
    <th>Departemen</th>
    <th width="80">Total</th>
    <th width="120">Apresiasi</th>
    <th width="100">Aksi</th>
</tr>
</thead>

<tbody>
@foreach($data as $i => $item)
<tr>

    <td class="text-center">{{ $i+1 }}</td>

    <td>{{ $item->peserta->name }}</td>
    <td>{{ $item->peserta->direktorat ?? '-' }}</td>
    <td>{{ $item->peserta->kompartemen ?? '-' }}</td>
    <td>{{ $item->peserta->unit_kerja ?? '-' }}</td>

    <td class="text-center">
        <b>{{ $item->total_nilai }}</b>
    </td>

    {{-- APRESIASI --}}
    <td class="text-center">
        @php $a = $item->apresiasi; @endphp

        @if($a == 'Diamond')
            <span class="badge bg-primary">💎 Diamond</span>
        @elseif($a == 'Platinum')
            <span class="badge bg-info">Platinum</span>
        @elseif($a == 'Gold')
            <span class="badge bg-warning text-dark">Gold</span>
        @elseif($a == 'Silver')
            <span class="badge bg-secondary">Silver</span>
        @elseif($a == 'Bronze')
            <span class="badge bg-dark">Bronze</span>
        @else
            -
        @endif
    </td>

    {{-- AKSI --}}
   <td class="text-center">

    {{-- DETAIL --}}
    <a href="{{ route('admin.nilai.detail', $item->id) }}"
       class="btn btn-info btn-sm me-1"
       title="Detail">
        <i class="bi bi-eye"></i>
    </a>

    {{-- EDIT (kalau belum publish) --}}
    @if($item->status != 'published')
        <a href="{{ route('admin.nilai.edit', $item->id) }}"
           class="btn btn-warning btn-sm"
           title="Edit">
            <i class="bi bi-pencil-square"></i>
        </a>
    @endif

</td>

</tr>
@endforeach
</tbody>

</table>
</div>

{{-- FINALISASI DI BAWAH --}}
<div class="mt-4 text-end">
    <form action="{{ route('admin.publish') }}" method="POST">
        @csrf

        <button class="btn btn-danger"
            onclick="return confirm('Finalisasi semua data? Tidak bisa diubah lagi!')">
            Finalisasi
        </button>
    </form>
</div>

</div>
</div>

</div>
</section>
</div>
@endsection
