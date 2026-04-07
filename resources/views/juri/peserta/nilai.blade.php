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
<div class="main-content">
    <section class="section">

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

                        <table>

<tr>
    <th>ITEM</th>
    <th>NO</th>
    <th>KRITERIA</th>
    <th>KETERANGAN</th>
    <th>RUJUKAN</th>
    <th>1-4</th>
    <th>5-6</th>
    <th>7-8</th>
    <th>9-10</th>
    <th>NILAI</th>
</tr>

<!-- PLAN -->
<tr class="plan">
    <td rowspan="3">PLAN</td>
    <td>1</td>
    <td>Penetapan Aktivitas</td>
    <td>1. Identifikasi masalah<br>2. Penetapan sasaran<br>3. Hubungan sebab dan akibat</td>
    <td>Langkah 1</td>
    <td>Masalah tidak teridentifikasi<br>Sasaran tidak jelas<br>Tidak ada korelasi</td>
    <td>Data kurang lengkap<br>Sasaran tidak sesuai<br>Korelasi tidak logis</td>
    <td>Data cukup akurat<br>Sasaran sesuai<br>Korelasi logis</td>
    <td>Data lengkap & akurat<br>Melebihi standar<br>Korelasi sangat baik</td>
    <td><input class="nilai" name="nilai[]" onkeyup="hitung()"></td>
</tr>

<tr class="plan">
    <td>2</td>
    <td>Pemecahan Masalah</td>
    <td>Analisis akar penyebab, perencanaan, pihak terkait</td>
    <td>Langkah 2-4</td>
    <td>Tidak berbasis data</td>
    <td>Kurang lengkap</td>
    <td>Cukup jelas</td>
    <td>Sangat lengkap & optimal</td>
    <td><input class="nilai" name="nilai[]" onkeyup="hitung()"></td>
</tr>

<tr class="plan">
    <td>3</td>
    <td>Solusi</td>
    <td>Kreativitas, keaslian, aplikatif</td>
    <td>Langkah 3-4</td>
    <td>Tidak efektif</td>
    <td>Memperbaiki yang ada</td>
    <td>Inovatif tingkat organisasi</td>
    <td>Inovasi baru tingkat nasional</td>
    <td><input class="nilai" name="nilai[]" onkeyup="hitung()"></td>
</tr>

<!-- DO -->
<tr class="do">
    <td rowspan="2">DO</td>
    <td>4</td>
    <td>Tingkat Kesulitan</td>
    <td>Kompetensi, monitoring, teamwork</td>
    <td>Langkah 4-5</td>
    <td>Tidak sesuai rencana</td>
    <td>Sebagian sesuai</td>
    <td>Sesuai & tepat</td>
    <td>Sempurna & mandiri</td>
    <td><input class="nilai" name="nilai[]" onkeyup="hitung()"></td>
</tr>

<tr class="do">
    <td>5</td>
    <td>Mutu Proses</td>
    <td>Evaluasi & validasi</td>
    <td>Langkah 5</td>
    <td>Tidak tepat</td>
    <td>Tidak konsisten</td>
    <td>Konsisten & tercapai</td>
    <td>Melampaui target</td>
    <td><input class="nilai" name="nilai[]" onkeyup="hitung()"></td>
</tr>

<!-- CHECK -->
<tr class="check">
    <td rowspan="2">CHECK</td>
    <td>6</td>
    <td>Evaluasi</td>
    <td>Dampak & pembelajaran</td>
    <td>Langkah 6</td>
    <td>Tidak teridentifikasi</td>
    <td>Teridentifikasi</td>
    <td>Ditanggulangi</td>
    <td>Optimal & sharing</td>
    <td><input class="nilai" name="nilai[]" onkeyup="hitung()"></td>
</tr>

<tr class="check">
    <td>7</td>
    <td>Dampak Hasil</td>
    <td>Finansial & manfaat</td>
    <td>Langkah 6</td>
    <td>< 50%</td>
    <td>< 100%</td>
    <td>= 100%</td>
    <td>> 100%</td>
    <td><input class="nilai" name="nilai[]" onkeyup="hitung()"></td>
</tr>



<!-- ACTION -->
<tr class="action">
    <td rowspan="1">ACTION</td>
    <td>8</td>
    <td>Standarisasi</td>
    <td>Standar & tindak lanjut</td>
    <td>Langkah 7-8</td>
    <td>Tidak ada standar</td>
    <td>Belum disosialisasi</td>
    <td>Sudah ada tapi belum terjamin</td>
    <td>Standar berjalan optimal</td>
    <td>
        <input class="nilai" name="nilai[]" onkeyup="hitung()">
    </td>
</tr>

<!-- CREATIVITY -->
<tr class="creativity">
    <td rowspan="2">CREATIVITY</td>
    <td>9</td>
    <td>Mutu Makalah</td>
    <td>Sistematika & estetika</td>
    <td>Risalah</td>
    <td>Sulit dimengerti</td>
    <td>Kurang menarik</td>
    <td>Jelas</td>
    <td>Sangat menarik</td>
    <td><input class="nilai" name="nilai[]" onkeyup="hitung()"></td>
</tr>

<tr class="creativity">
    <td>10</td>
    <td>Mutu Presentasi</td>
    <td>Kejelasan & daya tarik</td>
    <td>Presentasi</td>
    <td>Tidak informatif</td>
    <td>Kurang menarik</td>
    <td>Menarik</td>
    <td>Sangat menarik</td>
    <td><input class="nilai" name="nilai[]" onkeyup="hitung()"></td>
</tr>

<tr>
    <td colspan="9" class="text-center"><b>TOTAL NILAI</b></td>
    <td id="total">0</td>
</tr>

</table>

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
