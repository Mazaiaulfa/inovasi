<?php

namespace App\Charts;

use App\Models\Tahapan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UserPerTahapanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $labels = [];
        $data = [];

        // Ambil semua tahapan dengan relasi proposal > karya > user
        $tahapanList = Tahapan::with('proposals.karya.user')->orderBy('urutan')->get();

        foreach ($tahapanList as $tahapan) {
            $labels[] = $tahapan->nama;

            // Hitung user unik yang mengunggah pada tahapan ini
            $userIds = $tahapan->proposals->pluck('karya.user.id')->filter()->unique();
            $data[] = $userIds->count();
        }

        return $this->chart->areaChart()
            ->setTitle('Distribusi Pengguna per Tahapan')
            ->setSubtitle('Jumlah user yang telah upload dokumen per tahapan')
            ->addData('Jumlah User', $data)
            ->setXAxis($labels)
            ->setColors(['#3f83f8'])
            ->setMarkers(['#3f83f8'], 7, 10); // titik marker di garis
    }
}
