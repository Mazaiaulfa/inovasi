<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\KaryaTulis;
use App\Models\Proposal;
use App\Models\FinalKarya;
use App\Charts\ProposalStatusChart;
use App\Charts\JudulPerBulanChart;
use App\Charts\UserPerTahapanChart;
use App\Charts\FinalKaryaStatusChart;

class DashboardController extends Controller
{
    public function index(
        ProposalStatusChart $proposalChart,
        JudulPerBulanChart $judulChart,
        FinalKaryaStatusChart $finalChart,
        UserPerTahapanChart $userPerTahapanChart
    ) {

        // ================== GKM ==================
        $gkmUsers    = User::where('role','user')->where('jenis_peserta','GKM')->count();
        $gkmKarya    = KaryaTulis::whereHas('user', fn($q) => $q->where('role','user')->where('jenis_peserta','GKM'))->count();
        $gkmProposal = Proposal::whereHas('karya.user', fn($q) =>
    $q->where('role','user')->where('jenis_peserta','GKM')
)->count();
       $gkmFinal = FinalKarya::whereHas('karya.user', fn($q) =>
    $q->where('role','user')->where('jenis_peserta','GKM')
)->count();

        // ================== EIF ==================
        $eifUsers    = User::where('role','user')->where('jenis_peserta','EIF')->count();
        $eifKarya    = KaryaTulis::whereHas('user', fn($q) => $q->where('role','user')->where('jenis_peserta','EIF'))->count();
        $eifProposal = Proposal::whereHas('karya.user', fn($q) =>
    $q->where('role','user')->where('jenis_peserta','EIF')
)->count();
       $eifFinal = FinalKarya::whereHas('karya.user', fn($q) =>
    $q->where('role','user')->where('jenis_peserta','EIF')
)->count();

        return view('admin.dashboard', [
            'judulChart' => $judulChart->build(),
            'proposalChart' => $proposalChart->build(),
            'finalChart' => $finalChart->build(),
            'userTahapanChart' => $userPerTahapanChart->build(),

            // total umum
            'totalUsers' => User::where('role','user')->count(),
            'totalKarya' => KaryaTulis::whereHas('user', fn($q) => $q->where('role','user'))->count(),
            'totalProposal' => Proposal::whereHas('karya.user', fn($q) =>
    $q->where('role','user')
)->count(),

            'totalFinalKarya' => FinalKarya::whereHas('karya.user', fn($q) =>
    $q->where('role','user')
)->count(),
            // GKM
            'gkmUsers' => $gkmUsers,
            'gkmKarya' => $gkmKarya,
            'gkmProposal' => $gkmProposal,
            'gkmFinal' => $gkmFinal,

            // EIF
            'eifUsers' => $eifUsers,
            'eifKarya' => $eifKarya,
            'eifProposal' => $eifProposal,
            'eifFinal' => $eifFinal,

            // latest karya
            'latestKarya' => KaryaTulis::with('user')->latest()->take(5)->get(),
        ]);
    }
}
