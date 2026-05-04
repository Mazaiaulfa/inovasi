<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithTitle;


class RekapExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths,WithTitle
{
protected $id;
protected $tahun;
protected $jenis;

public function __construct($id = null, $tahun = null, $jenis = null)
{
    $this->id = $id;
    $this->tahun = $tahun;
    $this->jenis = $jenis;
}

   public function collection()
{
    $query = User::with(['karyaTulis' => function ($q) {

        if ($this->tahun) {
            $q->whereYear('created_at', $this->tahun);
        }

    }, 'anggota'])
    ->where('role', '!=', 'admin');

    // Filter tahun karya tulis
    if ($this->tahun) {
        $query->whereHas('karyaTulis', function ($q) {
            $q->whereYear('created_at', $this->tahun);
        });
    }

    // Filter jenis peserta (EIF / GKM / SS)
    if ($this->jenis && $this->jenis != 'all') {
        $query->where('jenis_peserta', $this->jenis);
    }

    // Filter user tertentu
    if ($this->id) {
        $query->where('id', $this->id);
    }

    $users = $query->get();

        $rows = collect();
        $no = 1;
        foreach ($users as $user) {

            $judulList = $user->karyaTulis->pluck('judul')->toArray();
            $statusList = $user->karyaTulis->pluck('status_judul')->toArray();

            $waktuUploadList = $user->karyaTulis->pluck('created_at')
                ->map(fn($d) => $d ? $d->format('d-m-Y') : '-')
                ->toArray();

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
                'No'           => $no++,
                'Nama User'    => $user->name,
                'Direktorat'   => $user->direktorat,
                'Kompartemen'  => $user->kompartemen,
                'Unit Kerja'   => $user->unit_kerja,
                'Judul'        => implode("\n", $judulList),
                'Status'       => implode("\n", $statusList),
                'Waktu Upload' => implode("\n", $waktuUploadList),
                'Fasilitator'  => implode("\n", $fasilitator),
                'Ketua'        => implode("\n", $ketua),
                'Anggota'      => implode("\n", collect($anggota)
                    ->values()
                    ->map(fn($v, $i) => ($i+1).'. '.$v)
                    ->toArray()),
            ]);
        }

        return $rows;
    }

    public function headings(): array
        {
            return [
                'No',
                'Nama User',
                'Direktorat',
                'Kompartemen',
                'Unit Kerja',
                'Judul',
                'Status',
                'Waktu Upload',
                'Fasilitator',
                'Ketua',
                'Anggota',
            ];

    }


    /*
    |--------------------------------------------------------------------------
    | WIDTH
    |--------------------------------------------------------------------------
    */
    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 25,
            'C' => 25, // Direktorat
            'D' => 25, // Kompartemen
            'E' => 20, // Unit Kerja
            'F' => 40,
            'G' => 18,
            'H' => 15,
            'I' => 25,
            'J' => 25,
            'K' => 40,
        ];
    }

public function title(): string
{
    return 'Daftar Gugus Tgl ' . now()->format('d-m-Y');
}
    /*
    |--------------------------------------------------------------------------
    | STYLES
    |--------------------------------------------------------------------------
    */
    public function styles(Worksheet $sheet)
    {
         $lastRow = $sheet->getHighestRow();

        // Header
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '4472C4'],
            ],
        ]);

        // Wrap + Top align
        $sheet->getStyle("A:K")->getAlignment()->setWrapText(true);
        $sheet->getStyle("A:K")->getAlignment()->setVertical(Alignment::VERTICAL_TOP);

        // Center nomor
        $sheet->getStyle("A2:A{$lastRow}")
              ->getAlignment()
              ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Border
        $sheet->getStyle("A1:K{$lastRow}")
              ->getBorders()
              ->getAllBorders()
              ->setBorderStyle(Border::BORDER_THIN);

        // Freeze header
        $sheet->freezePane('A2');

        return [];
    }
}
