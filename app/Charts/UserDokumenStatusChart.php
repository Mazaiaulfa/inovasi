<?php

namespace App\Charts;

use App\Models\KaryaTulis;
use App\Models\FinalKarya;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;

class UserDokumenStatusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function karyaTulisChart()
    {
        $userId = Auth::id();

        $statusCounts = KaryaTulis::where('user_id', $userId)
            ->selectRaw('status_judul, COUNT(*) as count')
            ->groupBy('status_judul')
            ->pluck('count', 'status_judul');

        $pending   = (int) ($statusCounts['pending'] ?? 0);
        $disetujui = (int) ($statusCounts['disetujui'] ?? 0);
        $ditolak   = (int) ($statusCounts['ditolak'] ?? 0);

        return $this->chart->donutChart()
            ->setTitle('Status Judul Makalah')
            ->setLabels(['Pending', 'Disetujui', 'Ditolak'])
            ->setDataset([$pending, $disetujui, $ditolak])
            ->setColors(['#ffc107', '#28a745', '#dc3545'])
            ->setHeight(350);
    }

    public function finalKaryaChart()
    {
        $userId = Auth::id();
    
        $statusCounts = FinalKarya::whereHas('karyaTulis', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');
    
        $pending   = (int) ($statusCounts['pending'] ?? 0);
        $disetujui = (int) ($statusCounts['disetujui'] ?? 0);
        $ditolak   = (int) ($statusCounts['ditolak'] ?? 0);
    
        return $this->chart->barChart()
            ->setTitle('Status Final Makalah')
            ->setLabels(['Pending', 'Disetujui', 'Ditolak'])
            ->setDataset([
                [
                    'name' => 'Pending',
                    'data' => [$pending, 0, 0],
                ],
                [
                    'name' => 'Disetujui',
                    'data' => [0, $disetujui, 0],
                ],
                [
                    'name' => 'Ditolak',
                    'data' => [0, 0, $ditolak],
                ],
            ])
            ->setColors(['#ffc107', '#28a745', '#dc3545'])
            ->setHeight(350);
    }
}
