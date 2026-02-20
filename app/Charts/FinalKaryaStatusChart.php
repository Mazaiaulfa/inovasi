<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\FinalKarya;

class FinalKaryaStatusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $data = [
            'Menunggu' => FinalKarya::where('status', 'pending')->count(),
            'Disetujui' => FinalKarya::where('status', 'disetujui')->count(),
            'Ditolak' => FinalKarya::where('status', 'ditolak')->count(),
        ];

        return $this->chart->radialChart()
            ->setTitle('Status Finalisasi Makalah')
            ->setLabels(array_keys($data))
            ->setHeight(350)
            ->setDataset(array_values($data));
    }
}
