@extends('layouts.app')
@section('title', 'Tambah Kriteria')
@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.dataTables_wrapper .dataTables_filter {
    display: flex !important;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    flex-direction: row-reverse;
}

.main-content {
    padding-top: 20px;
}

.modern-tabs {
    display: flex;
    gap: 20px;
    border-bottom: 1px solid #e5e7eb;
}

.tab-item {
    padding: 12px 5px;
    cursor: pointer;
    font-weight: 500;
    color: #6b7280;
    position: relative;
}

.tab-item.active {
    color: #4f46e5;
}

.tab-item.active::after {
    content: "";
    position: absolute;
    bottom: -1px;
    width: 100%;
    height: 3px;
    background: #4f46e5;
}
</style>
@endpush

@section('main')
<div class="main-content">
<div class="container-fluid">

<div class="card">
<div class="card-header">
    <h4 class="mb-0">Edit Kriteria</h4>
</div>

<div class="card-body">

<form action="{{ route('admin.kriteria.update', $kriteria->id) }}" method="POST">
@csrf
@method('PUT')

{{-- ================= INFORMASI ================= --}}
<div class="card mb-4 border">
    <div class="card-header bg-light">
        <strong>Informasi Kriteria</strong>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <label class="form-label">Item</label>
            <select name="item" class="form-control" required>
                @foreach(['PLAN','DO','CHECK','ACT'] as $opt)
                    <option value="{{ $opt }}"
                        {{ $kriteria->item == $opt ? 'selected' : '' }}>
                        {{ $opt }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>No</label>
            <input type="number" name="no" class="form-control"
                value="{{ $kriteria->no }}" required>
        </div>

        <div class="mb-3">
            <label>Nama Kriteria</label>
            <input type="text" name="nama" class="form-control"
                value="{{ $kriteria->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3" required>{{ $kriteria->keterangan }}</textarea>
        </div>

        <div class="mb-3">
            <label>Rujukan</label>
            <input type="text" name="rujukan" class="form-control"
                value="{{ $kriteria->rujukan }}">
        </div>

    </div>
</div>

{{-- ================= SKALA ================= --}}
<div class="card border">
    <div class="card-header bg-light">
        <strong>Skala Penilaian</strong>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <label>Skala 1 - 4</label>
            <textarea name="skala_1_4" class="form-control" rows="3" required>{{ $kriteria->skala_1_4 }}</textarea>
        </div>

        <div class="mb-3">
            <label>Skala 5 - 6</label>
            <textarea name="skala_5_6" class="form-control" rows="3" required>{{ $kriteria->skala_5_6 }}</textarea>
        </div>

        <div class="mb-3">
            <label>Skala 7 - 8</label>
            <textarea name="skala_7_8" class="form-control" rows="3" required>{{ $kriteria->skala_7_8 }}</textarea>
        </div>

        <div class="mb-3">
            <label>Skala 9 - 10</label>
            <textarea name="skala_9_10" class="form-control" rows="3" required>{{ $kriteria->skala_9_10 }}</textarea>
        </div>

    </div>
</div>

{{-- ================= BUTTON ================= --}}
<div class="mt-4 d-flex justify-content-end gap-2">
    <a href="{{ route('admin.kriteria.index') }}" class="btn btn-secondary">
        Kembali
    </a>
    <button type="submit" class="btn btn-primary">
        Update
    </button>
</div>

</form>

</div>
</div>

</div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
$(function () {
    $('.kriteriaTable').DataTable({
        responsive: true
    });
});
</script>
@endpush
