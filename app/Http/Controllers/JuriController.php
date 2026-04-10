<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\PenilaianDetail;


class JuriController extends Controller
{
    public function peserta()
{
    $juri = auth()->user();

    $peserta = $juri->pesertaYangDinilai->map(function ($user) use ($juri) {

        $penilaian = Penilaian::where('user_id', $user->id)
            ->where('juri_id', $juri->id)
            ->first();

        $user->nilai = $penilaian ? $penilaian->total_nilai : null;
        $user->status = $penilaian ? $penilaian->status : 'draft';

        return $user;
    });

    return view('juri.peserta.index', compact('peserta'));
}

    // tampilkan form nilai
    public function penilaian($id)
    {
        $peserta = User::where('role','user')->findOrFail($id);
        $kriteria = Kriteria::orderBy('no')->get();

        return view('juri.peserta.nilai', compact('peserta', 'kriteria'));
    }

    // simpan nilai
  public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nilai.*' => 'nullable|integer|min:1|max:10'
        ]);

        // ambil / buat penilaian (biar bisa edit)
        $penilaian = Penilaian::firstOrCreate(
            [
                'user_id' => $request->user_id,
                'juri_id' => auth()->id(),
            ],
            [
                'status' => 'draft'
            ]
        );

        // ❌ tidak boleh edit kalau sudah submit / publish
        if ($penilaian->status != 'draft') {
            return back()->with('error', 'Tidak bisa mengubah, sudah submit');
        }

        $total = 0;

        // 🔥 hapus detail lama (biar bisa edit ulang)
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
        // 🔥 HITUNG APRESIASI
        // ===============================
        $apresiasi = $this->getApresiasi($total);

        // ===============================
        // 🔥 SIMPAN TOTAL + APRESIASI
        // ===============================
        $penilaian->update([
            'total_nilai' => $total,
            'apresiasi' => $apresiasi
        ]);

        return redirect()->route('juri.peserta')
            ->with('success', 'Nilai berhasil disimpan');
    }

public function submit($id)
{
    $penilaian = Penilaian::where('user_id', $id)
        ->where('juri_id', auth()->id())
        ->firstOrFail();

    if ($penilaian->status != 'draft') {
        return back()->with('error', 'Sudah submit');
    }

    $penilaian->update([
        'status' => 'submitted'
    ]);

    return back()->with('success', 'Berhasil submit permanen');
}


public function submitSemua()
{
    $juriId = auth()->id();

    $penilaian = Penilaian::where('juri_id', $juriId)
        ->where('status', 'draft')
        ->get();

    if ($penilaian->isEmpty()) {
        return back()->with('error', 'Tidak ada data untuk disubmit.');
    }

    foreach ($penilaian as $item) {
        $item->update([
            'status' => 'submitted'
        ]);
    }

    return back()->with('success', 'Semua penilaian berhasil disubmit.');
}


private function getApresiasi($total)
{
    if ($total >= 95 && $total <= 100) {
        return 'Diamond';
    } elseif ($total >= 85 && $total < 95) {
        return 'Platinum';
    } elseif ($total >= 75 && $total < 85) {
        return 'Gold';
    } elseif ($total >= 70 && $total < 75) {
        return 'Silver';
    } elseif ($total >= 60 && $total < 70) {
        return 'Bronze';
    } else {
        return null;
    }
}
}
