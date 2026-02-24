<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KaryaTulis;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifikasiJudulMail;

class VerifikasiJudulController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $karya = KaryaTulis::with('user')->latest();

// 🔥 TAMBAHKAN INI
if ($request->jenis && $request->jenis != 'all') {
    $karya->whereHas('user', function ($q) use ($request) {
        $q->where('jenis_peserta', $request->jenis);
    });
}

            return DataTables::of($karya)

                ->addIndexColumn()
                ->addColumn('jenis_peserta', function ($row) {

    $jenis = $row->user->jenis_peserta ?? null;

    if ($jenis == 'EIF') {
        return '<span class="badge bg-primary">EIF</span>';
    } elseif ($jenis == 'GKM') {
        return '<span class="badge bg-success">GKM</span>';
    }

    return '-';
})
                ->addColumn('file_ajukan', function ($row) {
                return asset($row->file_ajukan); // file sudah ada di public/uploads/file_judul
            })

                ->addColumn('catatan', function ($row) {
                    return $row->catatan_judul ?: '-';
                })
                ->addColumn('aksi', function ($row) {
                    return '
                        <button class="btn btn-info btn-sm btn-preview"
                                data-id="' . $row->id . '"
                                data-nama="' . $row->user->name . '"
                                data-judul="' . e($row->judul) . '"
                                data-status="' . $row->status_judul . '"
                                data-catatan="' . e($row->catatan_judul) . '"
                                data-file_ajukan="' . asset($row->file_ajukan) . '">
            <i class="fas fa-eye"></i> Preview
        </button>
                        <button class="btn btn-warning btn-sm btn-edit"
                                data-id="' . $row->id . '"
                                data-judul="' . e($row->judul) . '"
                                data-status="' . $row->status_judul . '">
                           <i class="fas fa-edit"></i> Edit
                        </button>

                        <button class="btn btn-danger btn-sm btn-delete  bi-trash""
                                data-id="' . $row->id . '">
                           <i class="fas fa-trash"></i> Hapus
                        </button>
                    ';
                })
                ->editColumn('status_judul', function ($row) {
                    $color = [
                        'pending' => 'warning',
                        'disetujui' => 'success',
                        'ditolak' => 'danger'
                    ][$row->status_judul] ?? 'secondary';

                    return '<span class="badge bg-' . $color . '">' . $row->status_judul . '</span>';
                })
                ->rawColumns(['aksi', 'status_judul', 'jenis_peserta'])
                ->make(true);
        }

        return view('admin.verifikasi.index');
    }

    public function edit($id)
    {

        $karya = KaryaTulis::findOrFail($id);
        return view('admin.verifikasi.edit', compact('karya'));
    }

    public function update(Request $request, $id)
    {
        $karya = KaryaTulis::findOrFail($id);

        if ($request->has('edit-judul')) {
            // Jika form berasal dari modal edit judul
            $request->validate([
                'edit-judul'     => 'required|string',
                'status_judul'   => 'required|in:pending,disetujui,ditolak',
            ]);

            $karya->update([
                'judul'          => $request->input('edit-judul'),
                'status_judul'   => $request->input('status_judul'),
            ]);
        } else {
            // Jika form berasal dari modal verifikasi (preview)
            $request->validate([
                'status_judul'   => 'required|in:pending,disetujui,ditolak',
                'catatan_judul'  => 'nullable|string',
            ]);

            $karya->update([
                'status_judul'   => $request->input('status_judul'),
                'catatan_judul'  => $request->input('catatan_judul'),
            ]);

             $status = $request->input('status_judul');
             $judul  = $karya->judul;
             $catatan  = $request->input('catatan_judul');
    }

    // ====== 🔔 KIRIM EMAIL KE USER ======
    Mail::to($karya->user->email)->send(
        new VerifikasiJudulMail($status, $judul,$catatan)
    );


        Alert::success('Berhasil!', 'Data telah diperbarui');
        return response()->json(['success' => true]);
    }


    public function destroy($id)
    {
        $proposal = Proposal::findOrFail($id);

        // Contoh: Cek apakah proposal memiliki relasi ke final_karya
        if ($proposal->final()->exists()) {
            Alert::error('Gagal!', 'Proposal tidak dapat dihapus karena memiliki relasi data.');
            return redirect()->route('admin.proposal.index');
        }

        $proposal->delete();
        Alert::success('Berhasil!', 'Proposal berhasil dihapus.');
        return redirect()->route('admin.proposal.index');
    }
}
