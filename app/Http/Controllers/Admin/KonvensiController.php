<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\KonvensiExport;
use App\Exports\RekapNilaiKonvensiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\Kriteria;
use App\Models\KaryaTulis;
use App\Models\PenilaianDetail;
class KonvensiController extends Controller
{
     public function index()
{
    $data = \App\Models\HasilAkhir::with('karya.user')
        ->orderByDesc('rata_nilai')  // ranking otomatis
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

    public function show($karyaId)
{
    $karya = KaryaTulis::with('user')->findOrFail($karyaId);

    $penilaians = Penilaian::with('juri')
        ->where('karya_id', $karyaId)
        ->get();

    return view('admin.konvensi.show', compact('karya', 'penilaians'));
}

  public function i($id)
{
    $penilaian = Penilaian::with(['karya.user', 'detail'])
        ->findOrFail($id);

    $peserta = $penilaian->karya->user;

    $kriteria = Kriteria::orderBy('no')->get();

    $nilaiLama = $penilaian->detail
        ->pluck('nilai', 'kriteria_id');

    return view('admin.konvensi.edit', compact(
        'penilaian',
        'peserta',
        'kriteria',
        'nilaiLama'
    ));
}

//     public function update(Request $request, $id)
// {
//     $penilaian = Penilaian::findOrFail($id);

//     $total = 0;

//     // hapus detail lama biar clean
//     $penilaian->detail()->delete();

//     foreach ($request->nilai as $kriteria_id => $nilai) {

//         if ($nilai === null || $nilai === '') continue;

//         $total += $nilai;

//         PenilaianDetail::create([
//             'penilaian_id' => $id,
//             'kriteria_id' => $kriteria_id,
//             'nilai' => $nilai,
//         ]);
//     }

//     $total = (float) $total;

//     if ($total >= 95 && $total <= 100) {
//         $apresiasi = 'Diamond';
//     } elseif ($total >= 85 && $total < 95) {
//         $apresiasi = 'Platinum';
//     } elseif ($total >= 75 && $total < 85) {
//         $apresiasi = 'Gold';
//     } elseif ($total >= 70 && $total < 75) {
//         $apresiasi = 'Silver';
//     } elseif ($total >= 60 && $total < 70) {
//         $apresiasi = 'Bronze';
//     } else {
//         $apresiasi = null;
//     }

//     // ===============================
//     // 🔥 UPDATE TOTAL + APRESIASI
//     // ===============================
//     $penilaian->update([
//         'total_nilai' => $total,
//         'apresiasi' => $apresiasi
//     ]);

//     return redirect()->route('admin.konvensi.index')
//         ->with('success', 'Nilai berhasil diupdate');
// }

public function detail($id)
{
    $penilaian = Penilaian::with(['detail', 'karya.user'])
        ->findOrFail($id);

    $peserta = $penilaian->karya->user;

    $kriteria = Kriteria::orderBy('no')->get();

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

public function exportRekap()
{
    return Excel::download(
        new RekapNilaiKonvensiExport,
        'Rekap_Nilai_Konvensi.xlsx'
    );
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
public function finalize()
{
    $data = \App\Models\HasilAkhir::where('is_complete', true)->get();

    if ($data->isEmpty()) {
        return back()->with('error', 'Tidak ada data yang bisa difinalisasi');
    }

    foreach ($data as $item) {
        $item->update([
            'is_published' => true
        ]);
    }

    return redirect()->route('admin.konvensi.index')
        ->with('success', 'Finalisasi berhasil dilakukan');
}

public function edit(Request $request, $id)
{
    $request->validate([
        'rata_nilai' => 'required|numeric|min:0|max:100'
    ]);

    \App\Models\HasilAkhir::where('id', $id)
        ->update(['rata_nilai' => $request->rata_nilai]);

    return back()->with('success', 'Berhasil diupdate');
}

public function update(Request $request, $id)
{
    $request->validate([
        'rata_nilai' => 'required|numeric|min:0|max:100'
    ]);

    \App\Models\HasilAkhir::where('id', $id)
        ->update([
            'rata_nilai' => $request->rata_nilai
        ]);

    return back()->with('success', 'Berhasil diupdate');
}
}
