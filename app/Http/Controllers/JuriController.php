<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\KaryaTulis;
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

            $karya = KaryaTulis::where('user_id', $user->id)->first();

            $penilaian = $karya
                ? Penilaian::where('karya_id', $karya->id)
                    ->where('juri_id', $juri->id)
                    ->first()
                : null;

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

        $karya = KaryaTulis::where('user_id', $request->user_id)->firstOrFail();

        $penilaian = Penilaian::firstOrCreate(
            [
                'karya_id' => $karya->id,
                'juri_id' => auth()->id(),
            ],
            [
                'user_id' => $request->user_id,
                'status' => 'draft'
            ]
        );

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

        // ✅ hanya simpan total
        $penilaian->update([
            'total_nilai' => $total
        ]);

        return back()->with('success', 'Nilai tersimpan (draft)');
    }

    // =========================
    // SUBMIT PERMANEN
    // =========================
    public function submit($userId)
    {
        $karya = KaryaTulis::where('user_id', $userId)->firstOrFail();

        $penilaian = Penilaian::where('karya_id', $karya->id)
            ->where('juri_id', auth()->id())
            ->firstOrFail();

        if ($penilaian->status != 'draft') {
            return back()->with('error', 'Sudah submit');
        }

        $penilaian->update([
            'status' => 'submitted'
        ]);

        $this->updateHasilAkhir($karya->id);

        return back()->with('success', 'Submit berhasil');
    }

    // =========================
    // SUBMIT SEMUA
    // =========================
    public function submitSemua()
    {
        $juriId = auth()->id();

        $penilaians = Penilaian::where('juri_id', $juriId)
            ->where('status', 'draft')
            ->get();

        if ($penilaians->isEmpty()) {
            return back()->with('error', 'Tidak ada data draft');
        }

        foreach ($penilaians as $item) {

            $item->update([
                'status' => 'submitted'
            ]);

            $this->updateHasilAkhir($item->karya_id);
        }

        return back()->with('success', 'Semua berhasil disubmit');
    }

    // =========================
    // UPDATE HASIL AKHIR
    // =========================
    private function updateHasilAkhir($karyaId)
    {
        $penilaians = Penilaian::where('karya_id', $karyaId)
            ->where('status', 'submitted');

        $jumlah_juri = $penilaians->count();
        $rata_nilai = $penilaians->avg('total_nilai');

        $karya = KaryaTulis::findOrFail($karyaId);

        $total_juri = DB::table('juri_peserta')
            ->where('peserta_id', $karya->user_id)
            ->count();

        $is_complete = ($jumlah_juri == $total_juri && $total_juri > 0);

        // ✅ HITUNG APRESIASI DI SINI
        $apresiasi = $this->getApresiasi($rata_nilai);

        HasilAkhir::updateOrCreate(
            ['karya_id' => $karyaId],
            [
                'rata_nilai' => $rata_nilai,
                'jumlah_juri' => $jumlah_juri,
                'total_juri' => $total_juri,
                'is_complete' => $is_complete,
                'apresiasi' => $apresiasi,
            ]
        );
    }

    // =========================
    // APRESIASI (FINAL)
    // =========================
    private function getApresiasi($nilai)
    {
        if ($nilai >= 95) return 'Diamond';
        if ($nilai >= 85) return 'Platinum';
        if ($nilai >= 75) return 'Gold';
        if ($nilai >= 70) return 'Silver';
        if ($nilai >= 60) return 'Bronze';

        return null;
    }
}
