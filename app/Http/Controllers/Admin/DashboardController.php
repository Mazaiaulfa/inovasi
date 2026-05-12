<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\KaryaTulis;
use App\Models\Proposal;
use App\Models\FinalKarya;
use App\Models\HasilAkhir;

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
        $gkmUsers = User::where('role','user')
            ->where('jenis_peserta','GKM')
            ->count();

        $gkmKarya = KaryaTulis::whereHas('user', fn($q) =>
            $q->where('role','user')
              ->where('jenis_peserta','GKM')
        )->count();

        $gkmProposal = Proposal::whereHas('karya.user', fn($q) =>
            $q->where('role','user')
              ->where('jenis_peserta','GKM')
        )->count();

        $gkmFinal = FinalKarya::whereHas('karya.user', fn($q) =>
            $q->where('role','user')
              ->where('jenis_peserta','GKM')
        )->count();


        // ================== EIF ==================
        $eifUsers = User::where('role','user')
            ->where('jenis_peserta','EIF')
            ->count();

        $eifKarya = KaryaTulis::whereHas('user', fn($q) =>
            $q->where('role','user')
              ->where('jenis_peserta','EIF')
        )->count();

        $eifProposal = Proposal::whereHas('karya.user', fn($q) =>
            $q->where('role','user')
              ->where('jenis_peserta','EIF')
        )->count();

        $eifFinal = FinalKarya::whereHas('karya.user', fn($q) =>
            $q->where('role','user')
              ->where('jenis_peserta','EIF')
        )->count();


        // ================== SS ==================
        $ssUsers = User::where('role','user')
            ->where('jenis_peserta','SS')
            ->count();

        $ssKarya = KaryaTulis::whereHas('user', fn($q) =>
            $q->where('role','user')
              ->where('jenis_peserta','SS')
        )->count();

        $ssProposal = Proposal::whereHas('karya.user', fn($q) =>
            $q->where('role','user')
              ->where('jenis_peserta','SS')
        )->count();

        $ssFinal = FinalKarya::whereHas('karya.user', fn($q) =>
            $q->where('role','user')
              ->where('jenis_peserta','SS')
        )->count();


        // ================== PROGRESS ==================
        $complete = HasilAkhir::where('is_complete', 1)->count();

        $progress = HasilAkhir::where('is_complete', 0)->count();


        // ================== TREND TAHUN ==================
        $trend = KaryaTulis::select(
                DB::raw('YEAR(created_at) as tahun'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        $trendYear = $trend->pluck('tahun');

        $trendData = $trend->pluck('total');


        return view('admin.dashboard', [

            // chart lama
            'judulChart' => $judulChart->build(),
            'proposalChart' => $proposalChart->build(),
            'finalChart' => $finalChart->build(),
            'userTahapanChart' => $userPerTahapanChart->build(),

            // total umum
            'totalUsers' => User::where('role','user')->count(),

            'totalKarya' => KaryaTulis::whereHas('user', fn($q) =>
                $q->where('role','user')
            )->count(),

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

            // SS
            'ssUsers' => $ssUsers,
            'ssKarya' => $ssKarya,
            'ssProposal' => $ssProposal,
            'ssFinal' => $ssFinal,

            // progress
            'complete' => $complete,
            'progress' => $progress,

            // trend
            'trendYear' => $trendYear,
            'trendData' => $trendData,

            // latest karya
            'latestKarya' => KaryaTulis::with('user')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
