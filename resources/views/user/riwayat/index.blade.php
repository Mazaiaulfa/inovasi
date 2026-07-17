@extends('layouts.app')

@section('title', 'Riwayat Pengajuan')


@push('style')
<style>
    .table thead tr{
    overflow:hidden;
}

.table thead th:first-child{
    border-top-left-radius:12px;
}

.table thead th:last-child{
    border-top-right-radius:12px;
}

.table thead th{
    background:linear-gradient(135deg,#4f46e5,#6366f1) !important;
    color:white !important;
    border:none !important;
    padding:15px;
    font-size:13px;
    font-weight:700;
    letter-spacing:.4px;
    text-transform:uppercase;
}

.table thead tr{
    overflow:hidden;
}

.table thead th:first-child{
    border-top-left-radius:12px;
}

.table thead th:last-child{
    border-top-right-radius:12px;
}
</style>
@endpush
@section('main')
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Riwayat Pengajuan</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul Karya</th>
                                    <th width="15%">Tahun</th>
                                    <th width="20%">Status</th>
                                    <th width="15%" class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($karyas as $karya)
                                @php
                                    $hasil = $karya->hasilAkhir;

                                    if (!$hasil) {
                                        $status = ['text' => 'Belum dinilai', 'class' => 'text-secondary'];
                                    } elseif ($hasil->is_complete == 0) {
                                        $status = ['text' => 'Sedang Dinilai', 'class' => 'text-info'];
                                    } elseif ($hasil->is_complete == 1 && $hasil->is_published == 0) {
                                        $status = ['text' => 'Menunggu Publish', 'class' => 'text-warning'];
                                    } else {
                                        $status = ['text' => 'Selesai', 'class' => 'text-success'];
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $karya->judul }}
                                    </td>

                                    <td>{{ $karya->created_at->format('Y') }}</td>

                                    <td>
                                        <span class="{{ $status['class'] }}">
                                            {{ $status['text'] }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('riwayat.show', $karya->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                        Belum ada pengajuan
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </section>
</div>
@endsection
