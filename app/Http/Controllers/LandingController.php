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
    $totalJudul = KaryaTulis::count();
    $pendingProposal = Proposal::where('status', 'pending')->count();
    $totalFinalisasi = FinalKarya::count();
    $totalUser = User::count();

    // FIXED (tanpa kolom yang sudah dihapus)
    $pengumuman = Pengumuman::where('is_active', 1)
        ->latest()
        ->take(6)
        ->get();

    $timelines = Timeline::orderBy('urutan')->get();

    return view('welcome', compact(
        'totalJudul',
        'pendingProposal',
        'totalFinalisasi',
        'totalUser',
        'pengumuman',
        'timelines'
    ));

}

public function detail($id)
{
    $pengumuman = \App\Models\Pengumuman::findOrFail($id);
    return view('detail_pengumuman', compact('pengumuman'));
}


}
