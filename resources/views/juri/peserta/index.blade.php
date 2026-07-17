@extends('layouts.app')

@section('title', 'Daftar Peserta')

@push('style')
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">

<style>
.card{
    border:none;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 4px 20px rgba(0,0,0,.06);
}

.table-modern{
    width:100%;
    border-collapse:separate;
    border-spacing:0;
}

.table-modern thead th{
    background:#f8fafc;
    color:#64748b;
    font-size:15px;
    font-weight:700;
    padding:18px;
    border-bottom:1px solid #e5e7eb;
    border-right:1px solid #edf2f7;
    vertical-align:middle;
}

.table-modern tbody td{
    padding:18px;
    border-bottom:1px solid #edf2f7;
    border-right:1px solid #edf2f7;
    vertical-align:top;
}

.table-modern tbody tr:hover{
    background:#fafcff;
}

.table-modern th:first-child,
.table-modern td:first-child{
    width:70px;
}

.badge-status{
    display:inline-block;
    padding:10px 18px;
    border-radius:30px;
    font-size:14px;
    font-weight:700;
}

.status-success{
    background:#22c55e;
    color:#fff;
}

.status-warning{
    background:#f59e0b;
    color:#fff;
}

.status-secondary{
    background:#94a3b8;
    color:#fff;
}

.action-btn{
    width:34px;
    height:34px;
    border:none;
    border-radius:8px;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    transition:.2s;
    margin:auto;
}

.action-btn i{
    font-size:10px;
}

.action-btn:hover{
    color:#fff;
    transform:translateY(-2px);
}

.btn-view{
    background:#38bdf8;
}

.btn-edit{
    background:#f59e0b;
}

.btn-delete{
    background:#ef4444;
}

.nilai-text{
    color:#4f46e5;
    font-weight:700;
}

.not-rated{
    color:#f59e0b;
    font-weight:600;
}

.top-toolbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.progress-card{
    background:#f8fafc;
    border-radius:10px;
    padding:12px 18px;
    border:1px solid #e5e7eb;
}

.btn-locked{
    width:34px;
    height:34px;
    border-radius:8px;
    background:#475569;
    color:#fff;
    cursor:not-allowed;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    box-shadow:0 2px 8px rgba(71,85,105,.25);
}

.btn-locked i{
    font-size:13px;
}

.btn-locked:hover{
    background:#475569;
    color:#fff;
    transform:none;
}
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Daftar Peserta</h1>
        </div>
        <div class="section-body">
    <div class="alert alert-info mb-4" style="border-radius:10px;">
    <i class="fas fa-info-circle me-2"></i>
    Silakan lakukan penilaian untuk seluruh peserta yang ditugaskan.
    Setelah semua penilaian selesai, klik tombol
    <b>Submit</b> untuk menyimpan dan mengirim hasil penilaian secara final.
    Penilaian yang telah disubmit tidak dapat diedit kembali.
</div>
    <div class="card">
    <div class="card-body">

        @php
            $belumDinilai = $peserta->where('nilai', null)->count();
            $totalPeserta = $peserta->count();
            $sudahDinilai = $totalPeserta - $belumDinilai;
            $sudahSubmitSemua = $peserta->every(function ($item) {
        return $item->status == 'submitted';
    });
        @endphp


        <div class="top-toolbar">

            <div class="progress-card">
                <b>Progress:</b>
                {{ $sudahDinilai }}/{{ $totalPeserta }}

                &nbsp; | &nbsp;

                <b style="color:#ef4444">
                    Belum Dinilai:
                    {{ $belumDinilai }}
                </b>
            </div>

        </div>

        <div class="table-responsive">

            <table class="table-modern">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Email</th>
                        <th>Departemen</th>
                        <th>Nilai</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($peserta as $key => $item)

                    <tr>

                        <td>{{ $key + 1 }}</td>

                        <td>
                            <strong>{{ $item->name }}</strong>
                        </td>

                        <td>
                            {{ $item->email }}
                        </td>

                        <td>
                            {{ $item->unit_kerja }}
                        </td>

                        <td>

                            @if($item->nilai)

                                <span class="nilai-text">
                                    {{ number_format($item->nilai,0) }}
                                </span>

                            @else

                                <span class="not-rated">
                                    Belum Dinilai
                                </span>

                            @endif

                        </td>

                        <td>

                            @if($item->status == 'submitted')

                                <span class="">
                                    Submitted
                                </span>

                            @elseif($item->status == 'draft')

                                <span class="">
                                    Draft
                                </span>

                            @else

                                <span class="badge-status status-secondary">
                                    -
                                </span>

                            @endif

                        </td>

                       <td>

@if(!$sudahSubmitSemua)

    {{-- BELUM SUBMIT SEMUA --}}

    @if(empty($item->nilai))

        <a href="{{ route('juri.nilai.form',$item->id) }}"
           class="action-btn btn-view"
           title="Nilai">

            <i class="fas fa-check"></i>

        </a>

    @else

        <a href="{{ route('juri.nilai.form',$item->id) }}"
           class="action-btn btn-edit"
           title="Edit">

            <i class="fas fa-pen"></i>

        </a>

    @endif

@else

    {{-- SUDAH SUBMIT SEMUA --}}

    <a href="javascript:void(0)"
       class="action-btn btn-locked locked-action"
       title="Penilaian Terkunci">

        <i class="fas fa-lock"></i>

    </a>

@endif

</td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center py-5">
                            Belum ada peserta yang di-assign
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="text-end mt-4">

            <form action="{{ route('juri.submit.semua') }}"
                  method="POST">

                @csrf

                <button
                    type="submit"
                    class="btn btn-primary"
                    {{ $belumDinilai > 0 ? 'disabled' : '' }}
                    onclick="return confirm('Submit semua penilaian?')">

                    <i class="fas fa-paper-plane"></i>
                    Submit

                </button>

            </form>

        </div>

    </div>
</div>

        </div>

    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.locked-action').forEach(button => {

    button.addEventListener('click', function () {

        Swal.fire({
            icon: 'info',
            title: 'Penilaian Terkunci',
            text: 'Semua penilaian telah disubmit permanen dan tidak dapat diubah lagi.',
            confirmButtonColor: '#4f46e5',
            confirmButtonText: 'Mengerti'
        });

    });

});
</script>
@endpush
