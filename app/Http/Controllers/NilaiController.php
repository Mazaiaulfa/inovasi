<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Penilaian;
use App\Models\KaryaTulis;
use App\Models\PenilaianDetail;
use App\Models\Kriteria;

class NilaiController extends Controller
{
    // ===============================
    // FORM NILAI
    // ===============================
    public function create($id)
    {
        $peserta = User::findOrFail($id);

        $kriteria = Kriteria::orderBy('no')->get();

        // ambil penilaian milik juri
        $penilaian = Penilaian::where('user_id', $id)
            ->where('juri_id', auth()->id())
            ->first();

        // siapkan nilai lama
        $nilaiLama = [];

        if ($penilaian) {
            foreach ($penilaian->detail as $d) {
                $nilaiLama[$d->kriteria_id] = $d->nilai;
            }
        }

        return view('juri.peserta.nilai', compact(
            'peserta',
            'kriteria',
            'nilaiLama'
        ));
    }

    // ===============================
    // SIMPAN / EDIT NILAI
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nilai.*' => 'nullable|numeric|min:1|max:10'
        ]);

        // 🔥 ambil karya berdasarkan user
        $karya = KaryaTulis::where('user_id', $request->user_id)->firstOrFail();

        // 🔥 ambil / buat penilaian
        $penilaian = Penilaian::firstOrCreate(
            [
                'karya_id' => $karya->id,
                'user_id' => $request->user_id,
                'juri_id' => auth()->id(),
            ],
            [
                'total_nilai' => 0,
                'status' => 'draft'
            ]
        );

        // ❌ tidak boleh edit kalau sudah submit
        if ($penilaian->status != 'draft') {
            return back()->with('error', 'Tidak bisa mengubah, sudah submit');
        }

        $total = 0.0;

        // 🔥 hapus detail lama (biar update bersih)
        $penilaian->detail()->delete();

        foreach ($request->nilai as $kriteria_id => $nilai) {

            if ($nilai === null || $nilai === '') continue;

            $total += $nilai;

            PenilaianDetail::create([
                'penilaian_id' => $penilaian->id,
                'kriteria_id' => $kriteria_id,
                'nilai' => $nilai,
            ]);
        }

        // ===============================
        // ✅ SIMPAN TOTAL SAJA (TANPA APRESIASI)
        // ===============================
        $penilaian->update([
            'total_nilai' => (float) $total
        ]);

        return redirect()->route('juri.peserta')
            ->with('success', 'Nilai berhasil disimpan / diupdate');
    }
}
