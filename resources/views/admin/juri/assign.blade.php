@extends('layouts.app')
@section('title', 'Penetapan Peserta')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.main-content {
    padding-top: 20px;
}

.table-hover tbody tr:hover {
    background-color: #f9fafb;
}

.action-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}
</style>
@endpush

@section('main')
<div class="main-content">
    <div class="container-fluid">

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    Penetapan Peserta
                    <small class="text-muted">({{ $juri->name }})</small>
                </h5>

                <span class="badge bg-primary">
                    Terpilih: <span id="totalSelected">0</span>
                </span>
            </div>

            <div class="card-body">

                <!-- SEARCH + SELECT ALL -->
                <div class="action-bar">
                    <input type="text" id="search" class="form-control w-50"
                        placeholder="Cari nama / departemen...">

                    <button type="button" id="selectAll" class="btn btn-outline-primary btn-sm">
                        Pilih Semua
                    </button>
                </div>

                <form action="{{ route('admin.juri.assign') }}" method="POST">
                    @csrf
                    <input type="hidden" name="juri_id" value="{{ $juri->id }}">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">No</th>
                                    <th width="50">✔</th>
                                    <th>Nama Gugus</th>
                                    <th>Email</th>
                                    <th>Departemen</th>
                                    <th>Juri Penilai</th>
                                </tr>
                            </thead>
                            <tbody id="pesertaTable">
                                @foreach($peserta as $p)
                                <tr class="peserta-row">
                                    <td>{{ $loop->iteration }}</td> {{-- nomor otomatis --}}
                                    <td class="text-center">
                                        <input type="checkbox"
                                            class="form-check-input peserta-checkbox"
                                            name="peserta_id[]"
                                            value="{{ $p->id }}"
                                            {{ in_array($p->id, $selected) ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td>{{ $p->unit_kerja ?? '-' }}</td>
                                    <td>
                                    @if($p->juriPenilai->count())
                                        @foreach($p->juriPenilai as $j)
                                            <span class="badge bg-info text-dark mb-1">
                                                {{ $j->name }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Belum ada</span>
                                    @endif
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3 d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            Simpan
                        </button>

                        <a href="{{ route('admin.juri.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
const search = document.getElementById('search');
const rows = document.querySelectorAll('.peserta-row');
const checkboxes = document.querySelectorAll('.peserta-checkbox');
const totalSelected = document.getElementById('totalSelected');
const selectAllBtn = document.getElementById('selectAll');

// 🔍 SEARCH
search.addEventListener('keyup', function() {
    let value = this.value.toLowerCase();

    rows.forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value)
            ? '' : 'none';
    });
});

// ✅ COUNT SELECTED
function updateCount() {
    let count = document.querySelectorAll('.peserta-checkbox:checked').length;
    totalSelected.innerText = count;
}

updateCount();

checkboxes.forEach(cb => {
    cb.addEventListener('change', updateCount);
});

// 🔥 SELECT ALL
selectAllBtn.addEventListener('click', function() {
    let allChecked = [...checkboxes].every(cb => cb.checked);

    checkboxes.forEach(cb => {
        cb.checked = !allChecked;
    });

    updateCount();
});
</script>
@endpush
