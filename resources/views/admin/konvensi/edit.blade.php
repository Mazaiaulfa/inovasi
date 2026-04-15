@extends('layouts.app')

@section('title', 'Edit Nilai Peserta')

@push('style')
<style>
.table-custom {
    border-collapse: collapse;
    width: 100%;
    font-size: 10px;
}

.table-custom th,
.table-custom td {
    border: 1px solid #dee2e6;
    padding: 8px;
    vertical-align: top;
}

.table-custom th {
    background: #6c757d;
    color: white;
    text-align: center;
}

.plan { background: #fff9c4; }
.do { background: #d4edda; }
.check { background: #cfe2ff; }
.act { background: #f8d7da; }
.creativity { background: #e8f5e9; }

.text-wrap {
    max-width: 220px;
    white-space: pre-line;
}

.nilai {
    width: 50px;
    height: 28px;
    font-size: 11px;
    text-align: center;
}

.nilai::-webkit-outer-spin-button,
.nilai::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.nilai { -moz-appearance: textfield; }
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

<h5 class="text-center mb-4">
    {{ $peserta->name }}
</h5>

<form action="{{ route('admin.nilai.update', $penilaian->id) }}" method="POST">
@csrf
@method('PUT')

<div class="table-responsive">
<table class="table-custom">

<thead>
<tr>
    <th>Item</th>
    <th>No</th>
    <th>Kriteria</th>
    <th>Keterangan</th>
    <th>Rujukan</th>
    <th>1-4</th>
    <th>5-6</th>
    <th>7-8</th>
    <th>9-10</th>
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

<td class="text-wrap">
    {{ $k->rujukan }}
</td>

<td class="text-wrap">{!! nl2br(e($k->skala_1_4)) !!}</td>
<td class="text-wrap">{!! nl2br(e($k->skala_5_6)) !!}</td>
<td class="text-wrap">{!! nl2br(e($k->skala_7_8)) !!}</td>
<td class="text-wrap">{!! nl2br(e($k->skala_9_10)) !!}</td>

<td class="text-center">
    <input type="number"
           min="1"
           max="10"
           class="form-control nilai"
           name="nilai[{{ $k->id }}]"
           value="{{ $nilaiLama[$k->id] ?? '' }}"
           onkeyup="hitung()">
</td>

</tr>
@endforeach
@endforeach
</tbody>

<tfoot>
<tr>
    <th colspan="9" class="text-end">TOTAL</th>
    <th id="total">0</th>
</tr>
</tfoot>

</table>
</div>

<div class="mt-4 d-flex justify-content-end gap-2">
    <a href="{{ route('admin.nilai.show', $penilaian->karya_id) }}" class="btn btn-secondary">
        Kembali
    </a>

    <button type="submit" class="btn btn-success">
        Update Nilai
    </button>
</div>

</form>

</div>
</div>

</div>
</section>
</div>
@endsection

@push('scripts')
<script>
function hitung() {
    let total = 0;

    document.querySelectorAll(".nilai").forEach(i => {
        total += Number(i.value || 0);
    });

    document.getElementById("total").innerText = total;
}

document.addEventListener("DOMContentLoaded", function () {
    hitung();
});
</script>
@endpush
