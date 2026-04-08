<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Penilaian;
use App\Models\PenilaianDetail;
use App\Models\Kriteria;

class NilaiController extends Controller
{
    public function create($id)
{
    $peserta = User::findOrFail($id);

    // ambil semua kriteria
    $kriteria = Kriteria::orderBy('no')->get();

    return view('juri.peserta.nilai', compact('peserta', 'kriteria'));
}

    public function store(Request $request)
{
    // validasi
    $request->validate([
        'user_id' => 'required',
        'nilai.*' => 'nullable|numeric|min:0|max:10'
    ]);

    // cek kalau juri sudah pernah nilai
    $cek = Penilaian::where('user_id', $request->user_id)
        ->where('juri_id', auth()->id())
        ->first();

    if ($cek) {
        return back()->with('error', 'Anda sudah menilai peserta ini');
    }

    // simpan header
    $penilaian = Penilaian::create([
        'user_id' => $request->user_id,
        'juri_id' => auth()->id(),
    ]);

    // simpan detail
    foreach ($request->nilai as $kriteria_id => $nilai) {
        PenilaianDetail::create([
            'penilaian_id' => $penilaian->id,
            'kriteria_id' => $kriteria_id,
            'nilai' => $nilai,
        ]);
    }

    return redirect()->route('juri.peserta')
        ->with('success', 'Nilai berhasil disimpan');
}
}
