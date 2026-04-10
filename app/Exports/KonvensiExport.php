<?php

namespace App\Exports;

use App\Models\Penilaian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class KonvensiExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithColumnWidths,
    WithTitle
{

    public function collection()
    {
        $data = Penilaian::with(['peserta.anggota'])->get();

        $rows = collect();
        $no = 1;

        foreach ($data as $item) {

            $user = $item->peserta;

            $ketua = [];
            $fasilitator = [];
            $anggota = [];

            foreach ($user->anggota as $a) {

                $text = $a->nama . ' (' . $a->badge . ')';

                if (strtolower($a->jabatan) == 'ketua') {
                    $ketua[] = $text;
                } elseif (strtolower($a->jabatan) == 'fasilitator') {
                    $fasilitator[] = $text;
                } else {
                    $anggota[] = $text;
                }
            }

            $rows->push([
                'No' => $no++,
                'Nama' => $user->name,
                'Direktorat' => $user->direktorat,
                'Kompartemen' => $user->kompartemen,
                'Departemen' => $user->unit_kerja,
                'Total Nilai' => $item->total_nilai,
                'Fasilitator' => implode("\n", $fasilitator),
                'Ketua' => implode("\n", $ketua),
                'Anggota' => implode("\n", collect($anggota)
                    ->values()
                    ->map(fn($v, $i) => ($i+1).'. '.$v)
                    ->toArray()),
                'Apresiasi' => $item->apresiasi, // 🔥 pindah ke akhir
            ]);
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Direktorat',
            'Kompartemen',
            'Departemen',
            'Total Nilai',
            'Fasilitator',
            'Ketua',
            'Anggota',
            'Apresiasi',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 25,
            'C' => 25,
            'D' => 25,
            'E' => 25,
            'F' => 15,
            'G' => 30,
            'H' => 30,
            'I' => 40,
            'J' => 20,
        ];
    }

    public function title(): string
    {
        return 'Hasil Konvensi ' . now()->format('d-m-Y');
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();

        // 🔥 HEADER KUNING
        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000'], // hitam biar kontras
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'FFE600'], // 🔥 kuning
            ],
        ]);

        // WRAP TEXT
        $sheet->getStyle("A:J")->getAlignment()->setWrapText(true);

        // VERTICAL TOP
        $sheet->getStyle("A:J")->getAlignment()->setVertical(Alignment::VERTICAL_TOP);

        // 🔥 CENTER KOLOM TERTENTU
        $sheet->getStyle("A2:A{$lastRow}") // No
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle("C2:F{$lastRow}") // Direktorat s/d Total
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle("G2:H{$lastRow}") // Fasilitator & Ketua
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle("J2:J{$lastRow}") // Apresiasi
            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // BORDER
        $sheet->getStyle("A1:J{$lastRow}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        // FREEZE
        $sheet->freezePane('A2');

        return [];
    }
}
