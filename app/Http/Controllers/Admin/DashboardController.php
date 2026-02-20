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
        return view('admin.dashboard', [
            'judulChart' => $judulChart->build(),
            'proposalChart' => $proposalChart->build(),
            'finalChart' => $finalChart->build(),
            'userTahapanChart' => $userPerTahapanChart->build(),
            'totalUsers' => User::count(),
            'totalKarya' => KaryaTulis::count(),
            'totalProposal' => Proposal::count(),
            'totalFinalKarya' => FinalKarya::count(),
            'latestKarya' => KaryaTulis::with('user')->latest()->take(5)->get(),
        ]);
    }
}
