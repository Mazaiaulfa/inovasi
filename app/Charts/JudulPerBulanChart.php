<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\KaryaTulis;
use Illuminate\Support\Facades\DB;

class JudulPerBulanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $data = KaryaTulis::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $labels = [];
        $values = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = \Carbon\Carbon::create()->month($i)->format('F');
            $values[] = $data[$i] ?? 0;
        }

        return $this->chart->barChart()
            ->setTitle('Pengajuan Judul per Bulan')
            ->setXAxis($labels)
            ->addData('Jumlah', $values);
    }
}
