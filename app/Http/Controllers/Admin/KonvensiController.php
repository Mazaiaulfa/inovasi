<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\KonvensiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Kriteria;
use App\Models\PenilaianDetail;
class KonvensiController extends Controller
{
      public function index()
{
    $data = \App\Models\Penilaian::with('peserta')
        ->whereIn('status', ['submitted', 'reviewed', 'published']) // 🔥 tambah reviewed
        ->get();

    return view('admin.konvensi.index', compact('data'));
}

    public function create()
    {
        return view('admin.konvensi.create');
    }

    public function store(Request $request)
    {
        // simpan data
    }

    public function show($id)
    {
        //
    }

   public function edit($id)
{
    $penilaian = Penilaian::findOrFail($id);
    $peserta = $penilaian->peserta;
    $kriteria = Kriteria::all();

    $nilaiLama = PenilaianDetail::where('penilaian_id', $id)
        ->pluck('nilai', 'kriteria_id');

    return view('admin.konvensi.edit', compact(
        'penilaian',
        'peserta',
        'kriteria',
        'nilaiLama'
    ));
}

    public function update(Request $request, $id)
{
    $penilaian = Penilaian::findOrFail($id);

    $total = 0;

    // hapus detail lama biar clean
    $penilaian->detail()->delete();

    foreach ($request->nilai as $kriteria_id => $nilai) {

        if ($nilai === null || $nilai === '') continue;

        $total += $nilai;

        PenilaianDetail::create([
            'penilaian_id' => $id,
            'kriteria_id' => $kriteria_id,
            'nilai' => $nilai,
        ]);
    }

    // ===============================
    // 🔥 HITUNG APRESIASI (SAMA PERSIS)
    // ===============================
    $total = (float) $total;

    if ($total >= 95 && $total <= 100) {
        $apresiasi = 'Diamond';
    } elseif ($total >= 85 && $total < 95) {
        $apresiasi = 'Platinum';
    } elseif ($total >= 75 && $total < 85) {
        $apresiasi = 'Gold';
    } elseif ($total >= 70 && $total < 75) {
        $apresiasi = 'Silver';
    } elseif ($total >= 60 && $total < 70) {
        $apresiasi = 'Bronze';
    } else {
        $apresiasi = null;
    }

    // ===============================
    // 🔥 UPDATE TOTAL + APRESIASI
    // ===============================
    $penilaian->update([
        'total_nilai' => $total,
        'apresiasi' => $apresiasi
    ]);

    return redirect()->route('admin.konvensi.index')
        ->with('success', 'Nilai berhasil diupdate');
}

public function detail($id)
{
    $penilaian = \App\Models\Penilaian::with('detail')->findOrFail($id);

    $peserta = $penilaian->peserta;

    $kriteria = \App\Models\Kriteria::orderBy('no')->get();

    // mapping nilai per kriteria
    $nilaiDetail = $penilaian->detail
        ->pluck('nilai', 'kriteria_id');

    return view('admin.konvensi.detail', compact(
        'penilaian',
        'peserta',
        'kriteria',
        'nilaiDetail'
    ));
}

public function export()
{
    return Excel::download(new KonvensiExport, 'hasil-konvensi.xlsx');
}

public function publish()
{
    \App\Models\Penilaian::where('status', '!=', 'published')
        ->update([
            'status' => 'published'
        ]);

    return redirect()->route('admin.konvensi.index')
        ->with('success', 'Semua data berhasil difinalisasi');
}
}
