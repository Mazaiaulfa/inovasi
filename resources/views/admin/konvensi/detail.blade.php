@extends('layouts.app')
@section('title', 'Detail Penilaian')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.table-custom {
    border-collapse: collapse;
    width: 100%;
    font-size: 11px;
}

.table-custom th,
.table-custom td {
    border: 1px solid #000;
    padding: 6px;
    vertical-align: top;
}

.table-custom th {
    background: #ffe600;
    text-align: center;
    font-weight: bold;
}

/* warna item */
.plan { background: #fff9c4; }
.do { background: #d4edda; }
.check { background: #cfe2ff; }
.act { background: #f8d7da; }
.creativity { background: #e8f5e9; }

.text-wrap {
    white-space: pre-line;
}
</style>
@endpush

@section('main')
<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Detail Penilaian</h1>
</div>

<div class="section-body">
<div class="card">
<div class="card-body">

{{-- ===================== --}}
{{-- 🔥 INFO PESERTA --}}
{{-- ===================== --}}
<h5 class="text-center mb-3">
    {{ $peserta->name }}
</h5>

<div class="mb-3">
    <b>Direktorat:</b> {{ $peserta->direktorat ?? '-' }} <br>
    <b>Kompartemen:</b> {{ $peserta->kompartemen ?? '-' }} <br>
    <b>Departemen:</b> {{ $peserta->unit_kerja ?? '-' }}
</div>

<hr>

{{-- ===================== --}}
{{-- 🔥 RINGKASAN NILAI --}}
{{-- ===================== --}}
<div class="mb-3">
    <b>Total Nilai:</b> {{ $penilaian->total_nilai }} <br>



<hr>

{{-- ===================== --}}
{{-- 🔥 TABEL DETAIL NILAI --}}
{{-- ===================== --}}
<div class="table-responsive">
<table class="table-custom">

<thead>
<tr>
    <th>Item</th>
    <th>No</th>
    <th>Kriteria</th>
    <th>Keterangan</th>
    <th>Nilai</th>
</tr>
</thead>

<tbody>
@php
$group = $kriteria->groupBy('item');
@endphp

@foreach ($group as $item => $rows)
@php
$rowspan = count($rows);
$class = strtolower($item);
@endphp

@foreach ($rows as $index => $k)
<tr class="{{ $class }}">

@if ($index == 0)
<td rowspan="{{ $rowspan }}" class="text-center fw-bold">
    {{ $item }}
</td>
@endif

<td class="text-center">{{ $k->no }}</td>

<td>{{ $k->nama }}</td>

<td class="text-wrap">
    {!! nl2br(e($k->keterangan)) !!}
</td>

<td class="text-center">
    <b>{{ $nilaiDetail[$k->id] ?? '-' }}</b>
</td>

</tr>
@endforeach
@endforeach
</tbody>

<tfoot>
<tr>
    <th colspan="4" class="text-end">TOTAL</th>
    <th>{{ $penilaian->total_nilai }}</th>
</tr>
</tfoot>

</table>
</div>

<div class="mt-4">
    <a href="{{ route('admin.nilai.show', $penilaian->karya_id) }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

</div>
</div>
</div>

</section>
</div>
@endsection
