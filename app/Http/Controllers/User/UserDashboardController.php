<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\KaryaTulis;
use App\Models\Proposal;
use App\Models\FinalKarya;
use App\Charts\UserDokumenStatusChart;



class UserDashboardController extends Controller
{
    public function index(UserDokumenStatusChart $chart)
    {
        $user = Auth::user();

        // Menghitung total data berdasarkan user yang login
        $judulDiajukan = KaryaTulis::where('user_id', $user->id)->count();
        $draftDisetujui = Proposal::whereHas('karya', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'disetujui')->count();

        $finalDisetujui = FinalKarya::whereHas('karya', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'disetujui')->count();

        return view('user.dashboard', [
            'judulDiajukan' => $judulDiajukan,
            'draftDisetujui' => $draftDisetujui,
            'finalDisetujui' => $finalDisetujui,
            'karyaChart' => $chart->karyaTulisChart(),
            'finalChart' => $chart->finalKaryaChart(),
        ]);
    }
}
