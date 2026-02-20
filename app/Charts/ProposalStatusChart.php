<?php

namespace App\Charts;

use App\Models\Proposal;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ProposalStatusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $statusCounts = Proposal::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $pending   = (int) ($statusCounts['pending'] ?? 0);
        $disetujui = (int) ($statusCounts['disetujui'] ?? 0);
        $ditolak   = (int) ($statusCounts['ditolak'] ?? 0);

        return $this->chart->pieChart()
            ->setTitle('Status Verifikasi Makalah')
            ->setDataset([$pending, $disetujui, $ditolak])
            ->setLabels(['Pending', 'Disetujui', 'Ditolak'])
            ->setColors(['#ffc107', '#28a745', '#dc3545'])
            ->setHeight(350);
    }


}
