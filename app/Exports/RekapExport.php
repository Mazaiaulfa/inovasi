<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapExport implements FromCollection, WithHeadings, WithStyles
{
    protected $userId;

    public function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        $query = User::with(['karyaTulis', 'anggota']);

        if ($this->userId) {
            $query->where('id', $this->userId);
        }

        $users = $query->get();

        $rows = collect();

        foreach ($users as $user) {
            $judulList      = $user->karyaTulis->pluck('judul')->toArray();
            $statusList     = $user->karyaTulis->pluck('status_judul')->toArray();
            $waktuUploadList = $user->karyaTulis->pluck('created_at')
                ->map(function ($date) {
                    return $date ? $date->format('d-m-Y') : '-';
                })
                ->toArray();

            $rows->push([
                'Nama Gugus'   => $user->name,
                'Unit Kerja'  => $user->unit_kerja,
                'Judul'       => implode("\n", $judulList),
                'Status'      => implode("\n", $statusList),
                'Waktu Upload' => implode("\n", $waktuUploadList),
                'Anggota'     => $user->anggota->map(function ($anggota) {
                    return $anggota->nama . ' - ' . $anggota->jabatan;
                })->implode("\n"),
            ]);
        }

        return $rows;
    }


    public function headings(): array
    {
        return [
            'Nama User',
            'Unit Kerja',
            'Judul',
            'Status',
            'Anggota'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A:Z')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1:Z1')->getFont()->setBold(true);

        return [];
    }
}
