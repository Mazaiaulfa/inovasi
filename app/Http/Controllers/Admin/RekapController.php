<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapExport;
use App\Models\User;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with(['karyaTulis', 'anggota'])
            ->latest();

            return DataTables::of($users)
                ->addColumn('judul', function ($user) {
                    if ($user->karyaTulis->isEmpty()) {
                        return '<span class="text-muted">Tidak ada karya tulis</span>';
                    }

                    return $user->karyaTulis->map(function ($karya, $index) {
                        $separator = $index > 0 ? '<hr class="my-2">' : '';
                        return $separator . '<div>' . e($karya->judul) . '</div>';
                    })->implode('');
                })
                ->addColumn('tanggal_upload', function ($user) {
                    if ($user->karyaTulis->isEmpty()) {
                        return '<span class="text-muted">-</span>';
                    }

                    return $user->karyaTulis->map(function ($karya, $index) {
                        $separator = $index > 0 ? '<div class="my-3">' : '';
                        $tanggal = $karya->created_at ? $karya->created_at->translatedFormat('d-F-Y ') : '-';
                        return $separator . '<div><medium>' . $tanggal . '</medium></div>';
                    })->implode('');
                })
                ->addColumn('status', function ($user) {
                    if ($user->karyaTulis->isEmpty()) {
                        return '<span class="text-muted">-</span>';
                    }

                    return $user->karyaTulis->map(function ($karya, $index) {
                        $color = match ($karya->status_judul) {
                            'pending' => 'warning',
                            'disetujui' => 'success',
                            'ditolak' => 'danger',
                            default => 'secondary',
                        };

                        $separator = $index > 0 ? '<div class="my-2">' : '';
                        return $separator . '<div><span class="badge bg-' . $color . ' text-capitalize">'
                            . e($karya->status_judul) .
                            '</span></div>';
                    })->implode('');
                })
                ->addColumn('anggota', function ($user) {
                    return $user->anggota->map(function ($anggota) {
                        return '<div class="mb-1 text-capitalize">' . e($anggota->nama) . ' <span class="text-muted"> - ' . e($anggota->jabatan) . '</span></div>';
                    })->implode('');
                })
                ->addColumn('action', function ($user) {
                    return '<a href="' . route('rekap.export', $user->id) . '" class="btn btn-success btn-sm">
                                <i class="fas fa-file-excel"></i> Export
                            </a>';
                })
                ->rawColumns(['judul', 'tanggal_upload', 'status', 'anggota', 'action'])
                ->make(true);
        }

        return view('admin.rekap.index');
    }

public function history(Request $request)
{
    if ($request->ajax()) {
        $users = User::with(['karyaTulis','anggota'])
    ->when($request->tahun, function($query) use ($request) {
        $query->whereHas('karyaTulis', function($q) use ($request){
            $q->whereYear('created_at', $request->tahun);
        });
    })
    ->latest();

        return DataTables::of($users)
            ->addColumn('judul', function($user){
                return $user->karyaTulis->isEmpty()
                    ? '<span class="text-muted">Tidak ada karya tulis</span>'
                    : $user->karyaTulis->map(fn($k)=>"<div>{$k->judul}</div>")->implode('<hr>');
            })
            ->addColumn('tanggal_upload', function($user){
                return $user->karyaTulis->isEmpty()
                    ? '-'
                    : $user->karyaTulis->map(fn($k)=>"<div>".$k->created_at->translatedFormat('d F Y')."</div>")->implode('');
            })
            ->addColumn('status', function($user){
                return $user->karyaTulis->map(function($k){
                    $color = match($k->status_judul){
                        'pending'=>'warning',
                        'disetujui'=>'success',
                        'ditolak'=>'danger',
                        default=>'secondary'
                    };
                    return "<span class='badge bg-$color text-capitalize'>{$k->status_judul}</span>";
                })->implode('<br>');
            })
            ->addColumn('ketua', function($user){
                $ketua = $user->anggota
                    ->filter(fn($a) => strtolower($a->jabatan) === 'ketua')
                    ->map(fn($a) => "{$a->nama} ({$a->badge})")
                    ->implode('<br>');
                return $ketua ?: '-';
            })
            ->addColumn('fasilitator', function($user){
                $fasilitator = $user->anggota
                    ->filter(fn($a) => strtolower($a->jabatan) === 'fasilitator')
                    ->map(fn($a) => "{$a->nama} ({$a->badge})")
                    ->implode('<br>');
                return $fasilitator ?: '-';
            })
            ->addColumn('anggota_lain', function($user){
                $anggotaLain = $user->anggota
                    ->filter(fn($a) => !in_array(strtolower($a->jabatan), ['ketua','fasilitator']))
                    ->values()
                    ->map(fn($a, $index) => ($index+1).". {$a->nama} ({$a->badge})")
                    ->implode('<br>');
                return $anggotaLain ?: '-';
            })
                                ->addColumn('aksi', function ($row) {

                    return '
                    <a href="'.route('admin.history.show',$row->id).'"
                    class="btn btn-sm btn-primary">
                    <i class="fas fa-eye"></i> Detail
                    </a>

                    ';

                    })

            ->rawColumns(['judul','tanggal_upload','status','ketua','fasilitator','anggota_lain','aksi'])
            ->make(true);
    }

    return view('admin.rekap.history');
}

public function show($id)
{
    $gugus = User::with([
    'karyaTulis.proposals.tahapan',
    'karyaTulis.finalKarya',
    'anggota'
])->findOrFail($id);

    $gugus->ketua = $gugus->anggota
        ->firstWhere('jabatan', 'ketua')?->nama ?? '-';

    $gugus->fasilitator = $gugus->anggota
        ->firstWhere('jabatan', 'fasilitator')?->nama ?? '-';

    $gugus->anggota_lain = $gugus->anggota
        ->whereNotIn('jabatan', ['ketua','fasilitator']);

    $gugus->karyaTulis->each(function($k){
        $k->status_color = match($k->status_judul){
            'pending'=>'warning',
            'disetujui'=>'success',
            'ditolak'=>'danger',
            default=>'secondary'
        };
    });

    return view('admin.rekap.history.detail', compact('gugus'));
}
   public function export($id)
{
    return Excel::download(
        new RekapExport($id, null),
        'rekap_user.xlsx'
    );
}

public function exportAll(Request $request)
{
    $tahun = $request->tahun;

    $namaFile = $tahun
        ? 'rekap_inovasi_'.$tahun.'.xlsx'
        : 'rekap_semua_inovasi.xlsx';

    return Excel::download(
        new RekapExport(null, $tahun),
        $namaFile
    );
}

}
