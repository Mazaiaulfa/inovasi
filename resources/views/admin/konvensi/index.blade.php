@extends('layouts.app')
@section('title', 'Konvensi Inovasi')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
.card {
    border: none;
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.05);
    background: #fff;
}

.section-header h1 {
    font-weight: 700;
}

.table-konvensi {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 13px;
    background: #fff;
}

.table-konvensi thead th {
    background: #f8fafc;
    color: #333;
    font-weight: 600;
    text-align: center;
    padding: 12px;
    border-bottom: 1px solid #e5e7eb;
}

.table-konvensi tbody td {
    padding: 12px;
    border-bottom: 1px solid #f1f1f1;
    color: #444;
    vertical-align: middle;
    background: #fff;
}

.table-konvensi tbody tr:hover {
    background: #f9fbff;
}

.table-responsive {
    border-radius: 12px;
    overflow: hidden;
}

/* STATUS */
.status {
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.status.done {
    color: #1f7a3a;
}

.status.pending {
    color: #c0392b;
}

/* BUTTON */
.btn-sm {
    border-radius: 8px;
}
</style>
@endpush


@section('main')
<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Konvensi Inovasi</h1>
</div>
<div class="alert alert-info mb-3">
    <i class="fas fa-info-circle me-2"></i>
    Verifikasi seluruh hasil konvensi sebelum melakukan finalisasi. Data yang telah difinalisasi tidak dapat diedit kembali.
</div>
<div class="card">
<div class="card-body">
<div class="alert alert-info mb-3" style="border-radius:10px;">
    <i class="fas fa-file-excel me-2"></i>
    Rekapitulasi nilai konvensi dapat diunduh melalui tombol
    <b>Rekap Nilai Konvensi</b>. Pastikan seluruh penilaian telah selesai dan diverifikasi sebelum melakukan finalisasi.
</div>
<div class="mb-3 d-flex justify-content-end gap-3">
    <a href="{{ route('admin.konvensi.export') }}"
       class="btn btn-success btn-sm">
       <i class="fas fa-file-excel"></i>
        Data Konvensi
    </a>

    <a href="{{ route('admin.konvensi.export.rekap') }}"
       class="btn btn-primary btn-sm">
        <i class="fas fa-file-excel"></i>
        Rekap Nilai Konvensi
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
    <td>{{ $item->karya->user->name }}</td>
    <td>{{ $item->karya->judul ?? '-' }}</td>
    <td>{{ $item->karya->user->direktorat ?? '-' }}</td>
    <td>{{ $item->karya->user->kompartemen ?? '-' }}</td>
    <td>{{ $item->karya->user->unit_kerja ?? '-' }}</td>

    <td class="text-center">
        <b>{{ round($item->rata_nilai, 2) }}</b>
    </td>

    {{-- APRESIASI (tanpa emoji/icon) --}}
    <td class="text-center">
        {{ $item->apresiasi ?? '-' }}
    </td>

    {{-- STATUS --}}
    <td class="text-center">
        @if($item->is_complete)
            <span class="status done">Complete</span>
        @else
            <span class="status pending">In Progress</span>
        @endif
    </td>

    {{-- AKSI --}}
    <td class="text-center">
        <a href="{{ route('admin.nilai.show', $item->karya_id) }}"
           class="btn btn-primary btn-sm"><i class="bi bi-ticket-detailed-fill"></i>        </a>
         <button
            class="btn btn-warning btn-sm btn-edit"
            data-id="{{ $item->id }}"
            data-nilai="{{ $item->rata_nilai }}"
            data-bs-toggle="modal"
            data-bs-target="#modalEdit"><i class="bi bi-pen-fill"></i>

        </button>

    </td>
</tr>
@endforeach
</tbody>

</table>


</div>


{{-- ACTION BAWAH TABEL --}}
<div class="mt-3 d-flex justify-content-end gap-2">

    {{-- INFO kecil --}}
    <small class="text-muted align-self-center me-2">
        Pastikan semua data sudah selesai dinilai sebelum finalisasi
    </small>

    {{-- FINALISASI --}}
    <form action="{{ route('admin.nilai.finalize') }}"
          method="POST"
          onsubmit="return confirm('Yakin ingin finalisasi semua data? Setelah ini data akan dikunci.')">
        @csrf

        <button type="submit"
            class="btn btn-success btn-sm px-4"
            @if($data->where('is_complete', false)->count() > 0) disabled @endif>
            Finalisasi Semua
        </button>
    </form>
</div>
</div>
</div>
</section>
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius:12px">

      <form id="formEdit" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title">Edit Rata Nilai</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <input type="hidden" id="edit_id">

          <div class="mb-3">
            <label class="form-label">Rata Nilai</label>
            <input type="number" step="0.01" name="rata_nilai"
                   id="edit_nilai"
                   class="form-control"
                   required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success px-4">
            Simpan
          </button>
        </div>

      </form>

    </div>
  </div>
</div>
</div><script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('modalEdit');

    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        var id = button.getAttribute('data-id');
        var nilai = button.getAttribute('data-nilai');

        document.getElementById('edit_nilai').value = nilai;
        document.getElementById('formEdit').action = `/admin/konvensi/${id}`;
    });
});
</script>
@endsection
