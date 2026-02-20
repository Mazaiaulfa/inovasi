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

    public function export($id)
    {
        return Excel::download(new RekapExport($id), 'rekap.xlsx');
    }

    public function exportAll()
    {
        return Excel::download(new RekapExport(null), 'rekap_all.xlsx');
    }
}
