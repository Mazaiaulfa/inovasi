<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\PenilaianDetail;
use App\Models\HasilAkhir;
use Illuminate\Support\Facades\DB;

class JuriController extends Controller
{
    // =========================
    // LIST PESERTA
    // =========================
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

    // =========================
    // FORM NILAI
    // =========================
    public function penilaian($id)
    {
        $peserta = User::where('role','user')->findOrFail($id);
        $kriteria = Kriteria::orderBy('no')->get();

        return view('juri.peserta.nilai', compact('peserta', 'kriteria'));
    }

    // =========================
    // SIMPAN NILAI (DRAFT)
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nilai.*' => 'nullable|integer|min:1|max:10'
        ]);

        $penilaian = Penilaian::firstOrCreate(
            [
                'user_id' => $request->user_id,
                'juri_id' => auth()->id(),
            ],
            [
                'status' => 'draft'
            ]
        );

        // kalau sudah submit, tidak boleh edit
        if ($penilaian->status != 'draft') {
            return back()->with('error', 'Sudah submit, tidak bisa diubah');
        }

        $penilaian->detail()->delete();

        $total = 0;

        foreach ($request->nilai as $kriteria_id => $nilai) {

            if ($nilai === null || $nilai === '') continue;

            $total += $nilai;

            PenilaianDetail::create([
                'penilaian_id' => $penilaian->id,
                'kriteria_id' => $kriteria_id,
                'nilai' => $nilai,
            ]);
        }

        $penilaian->update([
            'total_nilai' => $total,
            'apresiasi' => $this->getApresiasi($total)
        ]);

        return back()->with('success', 'Nilai tersimpan (draft)');
    }

    // =========================
    // SUBMIT PERMANEN
    // =========================
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

        // 🔥 UPDATE HASIL AKHIR PESERTA
        $this->updateHasilAkhir($id);

        return back()->with('success', 'Submit berhasil');
    }

    // =========================
    // SUBMIT SEMUA
    // =========================
    public function submitSemua()
    {
        $juriId = auth()->id();

        $penilaian = Penilaian::where('juri_id', $juriId)
            ->where('status', 'draft')
            ->get();

        if ($penilaian->isEmpty()) {
            return back()->with('error', 'Tidak ada data draft');
        }

        foreach ($penilaian as $item) {

            $item->update([
                'status' => 'submitted'
            ]);

            // 🔥 update per peserta
            $this->updateHasilAkhir($item->user_id);
        }

        return back()->with('success', 'Semua berhasil disubmit');
    }

    // =========================
    // UPDATE HASIL AKHIR
    // =========================
    private function updateHasilAkhir($userId)
    {
        // ambil semua juri yang sudah submit
        $penilaians = Penilaian::where('user_id', $userId)
            ->where('status', 'submitted');

        $jumlah_juri = $penilaians->count();
        $rata_nilai = $penilaians->avg('total_nilai');

        // total juri yang ditugaskan
        $total_juri = DB::table('juri_peserta')
            ->where('peserta_id', $userId)
            ->count();

        $is_complete = ($jumlah_juri == $total_juri && $total_juri > 0);

        HasilAkhir::updateOrCreate(
            ['user_id' => $userId],
            [
                'rata_nilai' => $rata_nilai,
                'jumlah_juri' => $jumlah_juri,
                'total_juri' => $total_juri,
                'is_complete' => $is_complete,
            ]
        );
    }

    // =========================
    // APRESIASI
    // =========================
    private function getApresiasi($total)
    {
        if ($total >= 95) return 'Diamond';
        if ($total >= 85) return 'Platinum';
        if ($total >= 75) return 'Gold';
        if ($total >= 70) return 'Silver';
        if ($total >= 60) return 'Bronze';

        return null;
    }
}
