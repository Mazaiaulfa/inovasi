<?php

namespace App\Exports;

use App\Models\KaryaTulis;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class RekapNilaiKonvensiExport implements
    FromCollection,
    WithCustomStartCell,
    WithEvents,
    ShouldAutoSize
{
    public function startCell(): string
    {
        return 'A4';
    }

    public function collection()
    {
        $rows = [];

        $karyas = KaryaTulis::with([
            'user',
            'penilaian',
            'hasilAkhir'
        ])->get();

        foreach ($karyas as $index => $karya) {
            $juriColumns = [
                'J01' => '',
                'J02' => '',
                'J03' => '',
                'J04' => '',
                'J05' => '',
                'J06' => '',
                'J07' => '',
            ];

            $nilaiJuri = [];
            foreach (($karya->penilaian ?? collect()) as $i => $penilaian) {

                if ($i < 7) {

                    $column = 'J0' . ($i + 1);

                    $juriColumns[$column] = $penilaian->total_nilai;

                    $nilaiJuri[] = $penilaian->total_nilai;
                }
            }

            $rataRata = count($nilaiJuri)
                ? round(array_sum($nilaiJuri) / count($nilaiJuri), 2)
                : '';

            $deviasi = '';

            if (count($nilaiJuri) > 1) {

                $avg = array_sum($nilaiJuri) / count($nilaiJuri);

                $variance = array_sum(
                    array_map(
                        fn($nilai) => pow($nilai - $avg, 2),
                        $nilaiJuri
                    )
                ) / count($nilaiJuri);

                $deviasi = round(sqrt($variance), 2);
            }

            $rows[] = [

                $index + 1,

                $karya->user->name ?? '-',

                $karya->judul,

                // STREAM 1
                $juriColumns['J01'],
                $juriColumns['J02'],
                $juriColumns['J03'],
                $juriColumns['J04'],
                $juriColumns['J05'],
                $juriColumns['J06'],
                $juriColumns['J07'],

                // STREAM 2
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                // RESULT
                $rataRata,
                $deviasi,
                $karya->hasilAkhir->apresiasi ?? '-',
            ];
        }

        return new Collection($rows);
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                /*
                |--------------------------------------------------------------------------
                | MERGE HEADER
                |--------------------------------------------------------------------------
                */
                $sheet->mergeCells('A2:A3');
                $sheet->mergeCells('B2:B3');
                $sheet->mergeCells('C2:C3');

                $sheet->mergeCells('D2:J2');
                $sheet->mergeCells('K2:Q2');

                $sheet->mergeCells('R2:R3');
                $sheet->mergeCells('S2:S3');
                $sheet->mergeCells('T2:T3');

                /*
                |--------------------------------------------------------------------------
                | HEADER TITLE
                |--------------------------------------------------------------------------
                */

                $sheet->setCellValue('A2', 'NO');
                $sheet->setCellValue('B2', 'GKM');
                $sheet->setCellValue('C2', 'JUDUL');

                $sheet->setCellValue('D2', 'STREAM 1');
                $sheet->setCellValue('K2', 'STREAM 2');

                $sheet->setCellValue('R2', 'NILAI RATA-RATA');
                $sheet->setCellValue('S2', 'DEVIASI');
                $sheet->setCellValue('T2', 'PERINGKAT');

                /*
                |--------------------------------------------------------------------------
                | SUB HEADER STREAM 1
                |--------------------------------------------------------------------------
                */

                $stream = [
                    'J01',
                    'J02',
                    'J03',
                    'J04',
                    'J05',
                    'J06',
                    'J07'
                ];

                foreach ($stream as $i => $label) {

                    $sheet->setCellValue(
                        chr(ord('D') + $i) . '3',
                        $label
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | SUB HEADER STREAM 2
                |--------------------------------------------------------------------------
                */

                foreach ($stream as $i => $label) {

                    $sheet->setCellValue(
                        chr(ord('K') + $i) . '3',
                        $label
                    );
                }

                $lastRow = $sheet->getHighestRow();

                /*
                |--------------------------------------------------------------------------
                | COLUMN WIDTH
                |--------------------------------------------------------------------------
                */

                $sheet->getColumnDimension('A')->setWidth(8);
                $sheet->getColumnDimension('B')->setWidth(25);
                $sheet->getColumnDimension('C')->setWidth(30);

                foreach (range('D', 'Q') as $col) {
                    $sheet->getColumnDimension($col)->setWidth(8);
                }

                $sheet->getColumnDimension('R')->setWidth(18);
                $sheet->getColumnDimension('S')->setWidth(12);
                $sheet->getColumnDimension('T')->setWidth(16);

                /*
                |--------------------------------------------------------------------------
                | ROW HEIGHT
                |--------------------------------------------------------------------------
                */

                $sheet->getRowDimension(2)->setRowHeight(40);
                $sheet->getRowDimension(3)->setRowHeight(25);

                /*
                |--------------------------------------------------------------------------
                | COLORS
                |--------------------------------------------------------------------------
                */

                $green = 'A8C68A';
                $blue = 'D9E2F3';
                $grey = 'D9D9D9';
                $yellow = 'FFFF00';

                $sheet->getStyle('A2:C3')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $green]
                    ]
                ]);

                $sheet->getStyle('K2:Q2')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $green]
                    ]
                ]);

                $sheet->getStyle('R2:T3')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $green]
                    ]
                ]);

                $sheet->getStyle('D2:J3')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $blue]
                    ]
                ]);

                $sheet->getStyle('K3:Q3')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $grey]
                    ]
                ]);

                $sheet->getStyle("A4:A{$lastRow}")
                    ->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => $yellow]
                        ]
                    ]);

                /*
                |--------------------------------------------------------------------------
                | ALIGNMENT
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle("A2:T{$lastRow}")
                    ->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);

                $sheet->getStyle("A2:T3")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle("A2:T3")
                    ->getFont()
                    ->setBold(true);

                $sheet->getStyle("C4:C{$lastRow}")
                    ->getAlignment()
                    ->setWrapText(true);

                /*
                |--------------------------------------------------------------------------
                | BORDER
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle("A2:T{$lastRow}")
                    ->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => '000000']
                            ]
                        ]
                    ]);
            }
        ];
    }
}
