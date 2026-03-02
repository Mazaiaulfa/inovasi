<?php

namespace App\Http\Controllers;

use App\Models\KaryaTulis;
use App\Models\Proposal;
use App\Models\FinalKarya;
use App\Models\User;
use App\Models\Timeline;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Carbon\Carbon;

class LandingController extends Controller
{


public function index()
{
    // =========================
    // DATA DASHBOARD LAMA
    // =========================
    $totalJudul = KaryaTulis::count();
    $pendingProposal = Proposal::where('status', 'pending')->count();
    $totalFinalisasi = FinalKarya::count();
    $totalUser = User::count();

    // =========================
    // TAMBAHAN SLIDER PENGUMUMAN
    // =========================
    $pengumuman = Pengumuman::where('is_active', 1)
        ->whereDate('tanggal_mulai', '<=', Carbon::now())
        ->where(function ($q) {
            $q->whereNull('tanggal_selesai')
              ->orWhereDate('tanggal_selesai', '>=', Carbon::now());
        })
        ->orderBy('urgent', 'desc') // urgent di atas
        ->latest()
        ->take(6) // maksimal 6 slide
        ->get();

    // =========================
    // TAMBAHAN TIMELINE
    // =========================
    $timelines = Timeline::orderBy('urutan')->get(); // ambil timeline dari database

    return view('welcome', compact(
        'totalJudul',
        'pendingProposal',
        'totalFinalisasi',
        'totalUser',
        'pengumuman',
        'timelines' // tambahkan ini
    ));

}

public function detail($id)
{
    $pengumuman = \App\Models\Pengumuman::findOrFail($id);
    return view('detail_pengumuman', compact('pengumuman'));
}


}
