@extends('layouts.app')

@section('title', 'Form Nilai Inovasi')

@push('style')
<style>
table {
    border-collapse: collapse;
    width: 100%;
    font-size: 12px;
}

th, td {
    border: 1px solid #999;
    padding: 6px;
    vertical-align: top;
}

th {
    background: #ccc;
    text-align: center;
}

.plan { background: #f4f49a; }
.do { background: #00e676; }
.check { background: #cfe2f3; }
.action { background: #f9cb9c; }
.creativity { background: #d9ead3; }

input {
    width: 60px;
    text-align: center;
}
</style>
@endpush

@section('main')

    <div class="section-header">
        <h1>Form Nilai Inovasi</h1>
    </div>

    <div class="section-body">

        <div class="card">
            <div class="card-body">

                <h5 class="text-center mb-3">
                    {{ $peserta->name }}
                </h5>

                <form action="{{ route('juri.nilai.store') }}" method="POST">
                    @csrf

                    {{-- ID PESERTA --}}
                    <input type="hidden" name="user_id" value="{{ $peserta->id }}">

                    <table>

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

        {{-- ITEM (ROWSPAN) --}}
        @if ($index == 0)
            <td rowspan="{{ $rowspan }}">{{ $item }}</td>
        @endif

        <td>{{ $k->no }}</td>
        <td>{{ $k->nama }}</td>
        <td>{!! nl2br($k->keterangan) !!}</td>
        <td>{{ $k->rujukan }}</td>
        <td>{!! nl2br($k->skor_1_4) !!}</td>
        <td>{!! nl2br($k->skor_5_6) !!}</td>
        <td>{!! nl2br($k->skor_7_8) !!}</td>
        <td>{!! nl2br($k->skor_9_10) !!}</td>

        <td>
            <input class="nilai"
                   name="nilai[{{ $k->id }}]"
                   onkeyup="hitung()">
        </td>
    </tr>
@endforeach

@endforeach

                    <div class="mt-3 d-flex justify-content-end gap-2">
                        <a href="{{ route('juri.peserta') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                        <button type="submit" class="btn btn-success">
                            Simpan Nilai
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
</script>
@endpush
